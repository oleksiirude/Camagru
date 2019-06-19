<?php

	//show errors in browser
	//	ini_set('display_errors', 1);
	//	error_reporting(E_ALL);

	//define path to project directory
	define('ROOT', dirname(__FILE__)."/");

	//inclusion necessary files
	require_once (ROOT.'config/config.php');
	require_once (ROOT.'config/data.php');


	//inclusion necessary classes
	require_once (ROOT.'autoloader.php');

	//start session
	session_start();

	//launch router
	$route = new componentRouter();
	$route->run();