<?php
 /**
 *  Project: Reddit API small project
 *  Last Modified Date: 2017 July
 *  Developer: Cooltey Feng
 *  File: api/OpenURLRecord.php
 *  Description: API - Get the URL Record
 */
	 
	 include_once("../config/database.php");
	 include_once("../class/lib.php");
	 include_once("../class/api.php");

	 // get data
	 $getData = $_REQUEST;
	 
	 // call lib class
	 $getLib = new Lib();


	 // prevent magic quotes
	 $getLib->preventMagicQuote();
	 if(!class_exists("Lib")){
			echo "illegal";
			exit;
	 } 
	 
	 // call main class
	 $getMain = new API($db, $getLib);
	 	 
	 // return array
	 $result_array = array();
							
	 $result_array = $getMain->GetFeeds($getData);

	 // output json format
	 $getLib->outputJson($result_array);
?>