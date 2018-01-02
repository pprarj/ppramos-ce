<?php
	require 'environment.php';
	
	// Seta o fuso horário para GMT-3
	date_default_timezone_set("Brazil/East");

	global $config;
	$config = array();
	if(ENVIRONMENT == 'development') {
		define('BASE_URL', 'http://localhost/ppramos-ce');
		$config['environment'] = ENVIRONMENT;
		$config['dbname'] = 'ppramos-ce';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	} else {
		define('BASE_URL', 'http://192.168.1.35:8888/ppramos-ce');
		$config['environment'] = ENVIRONMENT;
		/*$config['dbname'] = '*********';
		$config['host'] = '*********';
		$config['dbuser'] = '*********';
		$config['dbpass'] = '*********';*/
		$config['dbname'] = 'ppramos-ce';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	}
?>
