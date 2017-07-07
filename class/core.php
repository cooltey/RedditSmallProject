<?php
 /**
 *  Project: Reddit API small project
 *  Last Modified Date: 2017 July
 *  Developer: Cooltey Feng
 *  File: class/core.php
 *  Description: Core Class
 */

class Core{

	var $db;
	var $getLib;
	var $pageName;
	
	function Core($get_db, $get_lib, $page){				
		$this->getLib 			= $get_lib;
		$this->db				= $get_db;
		$this->pageName    	 	= $page.".php";

	}

	// set html title
	function setTitle($getData){

		$returnVal = "";

		$currentPage = $this->getLib->setFilter($getData['p']);
		$getPage 	 = $this->pageName;

		switch($currentPage){
			case "index":
				$returnVal = "Index Page";
			break;
		}	

		return $returnVal;
	}

	// set view
	function setView($getData, $postData, $getSession){
		  
		$currentPage = $this->getLib->setFilter($getData['p']);
		$getPage 	 = $this->pageName;

		switch($currentPage){
			// Index Page 
			case "index":

				// load page
				include_once("./parts/index_page.php");
			break;
		}	
	}

}