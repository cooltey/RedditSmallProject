<?php
 /**
 *  Project: Reddit API small project
 *  Last Modified Date: 2017 July
 *  Developer: Cooltey Feng
 *  File: class/api.php
 *  Description: API Class
 */
 
class API{

	var $db;
	var $getLib;
	var $baseUrl;
	
	function API($get_db, $get_lib){				
		$this->getLib 				= $get_lib;
		$this->db					= $get_db;

		// reddit base url
		$this->baseUrl				= "https://www.reddit.com/";
	}

	function OutPutMessage($call_id){
		$theOutArray =  array("200", "404", "500");

		return $theOutArray[$call_id];
	}

	// GetFeeds.php 
	// get the feeds from Reddit API
	function GetFeeds($getData){

		$returnArray = array("StatusCode"	=> $this->OutPutMessage(1),
							 "Count"		=> 0,
							 "Next"			=> "",
							 "Prev"			=> "",
							 "List"			=> array());

		if($this->getLib->checkVal($getData['type'])){  
			
			try{
				$getType = $this->getLib->setFilter($getData['type']);

				// combine url
				$jsonUrl = $this->baseUrl.$getType.".json?";

				// check search
				if($this->getLib->checkVal($getData['keyword']) && $getData['keyword'] != ""){
					$getKeyword = $this->getLib->setFilter($getData['keyword']);
					$jsonUrl = $jsonUrl."&q=".$getKeyword;
				}

				// check after
				if($getData['next'] != ""){
					$getNext = $this->getLib->setFilter($getData['next']);
					$jsonUrl = $jsonUrl."&after=".$getNext;
				}

				// check before
				if($getData['prev'] != ""){
					$getPrev = $this->getLib->setFilter($getData['prev']);
					$jsonUrl = $jsonUrl."&before=".$getPrev;
				}

				// setup count
				if($getData['count'] != ""){
					$getCount = $this->getLib->setFilter($getData['count']);
					$jsonUrl = $jsonUrl."&count=".$getCount;
				}



				// fetch data
				$outputJson = array();

				$getJsonData = file_get_contents($jsonUrl);
				$getJsonData = json_decode($getJsonData, true);

				// we only need title, url, author and create time
				foreach($getJsonData['data']['children'] AS $jData){
					$rowData = array();

					$rowData['title'] 	= $jData['data']['title'];
					$rowData['url'] 	= $jData['data']['url'];
					$rowData['author'] 	= $jData['data']['author'];
					$rowData['time'] 	= date("Y-m-d H:i:s", $jData['data']['created']);

					// push data
					array_push($outputJson, $rowData);
				}

				// set data
				$returnArray['StatusCode'] 	= $this->OutPutMessage(0);
				$returnArray['Count'] 		= count($getJsonData['data']['children']);
				$returnArray['Next'] 		= $getJsonData['data']['after'];
				$returnArray['Prev'] 		= $getJsonData['data']['before'];
				$returnArray['List'] 		= $outputJson;

			}catch(Exception $e){
				$returnArray['StatusCode'] = $this->OutPutMessage(1);
			}
		}else{			
			$returnArray['StatusCode'] = $this->OutPutMessage(1);
		}


		return $returnArray;
	}	


}