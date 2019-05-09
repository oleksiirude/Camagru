<?php
//	echo "<pre>";
	//show errors in browser
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	//define path to project directory
	define('ROOT', dirname(__FILE__)."/");

	//inclusion necessary files
	require_once (ROOT.'config/config.php');
	require_once (ROOT.'config/tables.php');

	//inclusion necessary classes
	require_once (ROOT.'autoloader.php');

	//launch router
	$route = new componentRouter();
	$route->run();