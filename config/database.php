<?php
 /**
 *  Project: Reddit API small project
 *  Last Modified Date: 2017 July
 *  Developer: Cooltey Feng
 *  File: config/database.php
 *  Description: Database Settings
 */
 ini_set('session.cookie_httponly', 1);
 ini_set("magic_quotes_gpc", "on");
 ini_set("display_errors", "on");
 error_reporting(E_ALL & ~E_NOTICE);

 // cookie domain name
 $GLOBALS['cookie_folder_name'] = "/reddit_project";

 // // session setting
 session_set_cookie_params(0, $GLOBALS['cookie_folder_name'], "", FALSE, TRUE);
 session_start();

 header('X-Frame-Options: DENY');

 
?>