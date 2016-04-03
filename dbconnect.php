<?php 
	

	
	if (!isset($_SESSION)) {
		session_start();
	}
	$dbhost = 'mysql.kingfishcorvallis.com'; 
	$dbname = 'kingfishlounge';
	$dbuser = 'kingfishlounger';
	$dbpass = 'squirrelfish5!~';

	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Could not connect to database");
	
	
?>