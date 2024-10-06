<?php
/*!
	@file
	@brief This script is a semi-function that returns \a $arrDNAUserData and \a $oTicks
	
	@par Input Variables
	@li \a $numOldId revision id of the page to be checked and also a cutout revision for stats

	@par Return data
	@li \a $oTicks Ticks object that gathers some info on times
	@li \a $arrAuthors Stats for authors that didn't checked their revision as minor
	\code
	array
	(
		(num) => array
		(
			'user_name' => str,
			'edits_num' => int,
			'total_len' => int (in bytes), // should contain a sum of bytes removed and added
			'bytes_changed' => str (CSV of int), // list of bytes remove(-) and added(+)
		)
	)
	\endcode
*/

if (!defined('NO_HACKING'))
{
	die ('GO AWAY!');
}

//
// 0. ticks init
//
$oTicks = new cTicks();

//
// 1. get stats
//
$oTicks->pf_insTick('authors info');
$arrAuthors = $oData->pf_getPageAuthors($numOldId);
$oTicks->pf_endTick('authors info');

?>