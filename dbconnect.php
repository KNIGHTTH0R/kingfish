<?php 
	
	if (!isset($_SESSION)) {
		session_start();
	}
	
	$mysqli = new mysqli("127.0.0.1", "root", "", "kingfishlounge") or die("Could not connect to database");
	
	
?>