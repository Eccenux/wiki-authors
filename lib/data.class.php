<?php
// include an array selector class
//require_once './lib/arrayselect.class.php';

/*!
	@brief Data manipulation class.
*/
class cMainData
{
	private $db;	//!< PDO object
	private $dbSt;	//!< Last PDO Statement

	/*!
		@brief Construct
		
		@param [in] $strHost Database host
		@param [in] $strDbName Database name
		@param [in] $strUser Database user
		@param [in] $strPass Database user password
	*/
	public function __construct($strHost, $strDbName, $strUser, $strPass)
	{
		$this->db = new PDO(
			"mysql:host={$strHost};dbname={$strDbName}",
			$strUser, $strPass,
			array()
			// TS usues latin1_bin...
			//array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
		); 
	}

	/*!
		@brief Get authotrs stats for the page
		
		@param [in] $numOldId A revision id of the page to be checked and also a cut-out revision for stats
		
		@return $arrAuthors an array of authors stats containing: user_name, edits_num, total_len
	*/
	public function pf_getPageAuthors($numOldId)
	{
		global $oTicks;
		
		$numOldId = intval($numOldId);

		// get page id
		$oTicks->pf_insTick('authors page id');
		$strSQL = "SELECT rev_page
			FROM revision
			WHERE rev_id=$numOldId
		";
		
		$vPage = $this->pf_fetchAllSQL($strSQL, PDO::FETCH_COLUMN);
		$vPage = implode(",", $vPage);
		$oTicks->pf_endTick('authors page id');
		if (empty($vPage))
		{
			return array();
		}

		// get stats
		$oTicks->pf_insTick('authors stats');
		$strSQL = "SELECT rev_actor as actor_id, count(rev_actor) as `edits_num`, sum(rev_len) as `total_len`
			FROM revision_userindex
			WHERE rev_page=$vPage AND rev_minor_edit=0 AND rev_id<=$numOldId
			GROUP BY rev_actor
			ORDER BY 2 desc, 3 desc
		";
		$arrRevAuthors = $this->pf_fetchAllSQL($strSQL);
		$oTicks->pf_endTick('authors stats');
		if (empty($arrRevAuthors)) {
			return array();
		}

		// get names
		$oTicks->pf_insTick('authors names');
		$ids = array_column($arrRevAuthors, 'actor_id');
		$ids = implode(',', $ids);
		$strSQL = "SELECT actor_id, actor_name as `user_name`
			FROM actor
			WHERE actor_id IN ($ids)
		";
		//die("Przepraszamy");
		// PDO::FETCH_KEY_PAIR (id=>name)
		$arrAuthorNames = $this->pf_fetchAllSQL($strSQL, PDO::FETCH_KEY_PAIR);
		$oTicks->pf_endTick('authors names');
		
		// merge
		$oTicks->pf_insTick('authors merge');
		$arrAuthors = array();
		for ($i = 0; $i < count($arrRevAuthors); $i++) {
			$actor_id = $arrRevAuthors[$i]['actor_id'];
			if (isset($arrAuthorNames[$actor_id])) {
				$actor_name = $arrAuthorNames[$actor_id];
			} else {
				$actor_name = "? ($actor_id)";
			}
			$arr = array(
				'user_name' => $actor_name,
				'edits_num' => $arrRevAuthors[$i]['edits_num'],
				'total_len' => $arrRevAuthors[$i]['total_len'],
			);
			$arrAuthors[] = $arr;
		}
		$oTicks->pf_endTick('authors merge');
		
		return $arrAuthors;
	}

	/*!
		@brief Fetch all rows to an assoc array 
		
		@param [in] $strSQL The query
		@param [in] $pdoFetchStyle PDO fetch style (defaults to FETCH_ASSOC)
		
		@return rows returned by the server
		
		@see PDO::fetchAll();
	*/
	private function pf_fetchAllSQL($strSQL, $pdoFetchStyle=PDO::FETCH_ASSOC)
	{
		$this->dbSt = $this->db->prepare($strSQL);
		if (!$this->dbSt->execute())
		{
			$this->pf_throwSQLError();
			return false;
		}
		return $this->dbSt->fetchAll($pdoFetchStyle);
	}

	/*!
		@brief Throw SQL Error
		
		Throw SQL error (call after unsuccessful query execution)
	*/
	private function pf_throwSQLError()
	{
		$strSQL = $this->dbSt->queryString;
		$arrErr = $this->dbSt->errorInfo();
		trigger_error("\nSQL error: {$arrErr[2]}\nSQL:{$strSQL}\n", E_USER_ERROR);
	}

	/* --=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=-- *\
		END-OF-CLASS
	\* --=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=--=-- */
}

?>