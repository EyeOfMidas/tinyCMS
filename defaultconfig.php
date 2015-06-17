<?php
/*
 * NOTE: Do not change this file!
 * If you want to make local configuration changes,
 * create a config.php file with the defines you
 * would like to override.
 */

function _define($constString, $value) {
	if(!defined($constString)) {
		define($constString, $value);
	}
}
if(file_exists(dirname(__FILE__) ."/config.php")) {
	include(dirname(__FILE__). "/config.php");
}

//Default values
_define("DB_SERVER", "localhost");
_define("DB_USER", "tinyCMS");
_define("DB_PASS", "tinycms123");
_define("DB_NAME", "tinyCMS");

