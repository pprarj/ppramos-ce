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
		// retirado
	}
?>
