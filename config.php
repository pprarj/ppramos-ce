<?php
	require 'environment.php';
	
	// Seta o fuso horário para GMT-3
	date_default_timezone_set("Brazil/East");

	global $config;
	$config = array();
	if(ENVIRONMENT == 'development') {
		define('BASE_URL', 'http://localhost/');
		$config['environment'] = ENVIRONMENT;
		$config['dbname'] = '';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	} else {
		define('BASE_URL', 'http://www.');
		$config['environment'] = ENVIRONMENT;
		$config['dbname'] = 'pprarj';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'pprarjbd';
		$config['dbpass'] = 'SegReqNao01';
	}
?>