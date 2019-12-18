<?php
/*!
	@file
	@brief Main file
	
	@see \a .info.php (Main page) for details about the license and description of this project.
	@see \a index.getdata.php (Main script)
	
	@todo Wybór bazy!
	@todo Wybór języka
	@todo Możliwość wpisania tytułu strony zamiast oldid
*/
define('NO_HACKING', 1);
//header("Content-type: text/plain; charset=utf-8");
require('./_top.php');

// time limit
set_time_limit(600); 

//
// Preformat some variables
//
$numOldId = intval(empty($_GET['oldid']) ? 0 : $_GET['oldid']);
$strPageTitle = L('Authors:title');
$strDieMessage = '';
$strTplFile = 'index';
$strPageBaseURL = $arrSrcDb['page_base_url'];

if (empty($numOldId))
{
	$strDieMessage = L('Authors:oldid needed error');
}

//
// Get \a $arrAuthors and \a $oTicks
//
if (empty($strDieMessage))
{
	/**/
	require('./index.getdata.php');
	/**
	// quick test
	$arrAuthors = array();
	for ($i=0; $i < 10; $i++) { 
		$arr = array(
			'user_name' => 'Zenek' . ($i+1),
			'edits_num' => 123 - ($i*2),
			'total_len' => 132123,
		);
		$arrAuthors[] = $arr;
	}
	/**/
}

//
// Form ticks
//
if (!empty($oTicks))
{
	$arrTicks = $oTicks->pf_getDurations();
}

//
// Output
//
include('./view/_header.tpl.php');
if (empty($strDieMessage))
{
	include("./view/$strTplFile.tpl.php");
}
else
{
	echo $strDieMessage;
}
include('./view/_footer.tpl.php');
?>