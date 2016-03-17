<!DOCTYPE html>
<html>
<head>
	<title>Editting the <?=$_GET["menu"]?></title>
</head>
<body>


<?php

	function getdbc() {
		$dbhost = 'mysql.kingfishcorvallis.com'; 
		$dbname = 'kingfishloung';
		$dbuser = 'kingfishlounger@ip-208-113-156-25.dreamhost.com';
		$dbpass = 'squirrelfish5!~';
		
		$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    	or die("Error connecting to database server");

		mysql_select_db($dbname, $mysql_handle)
			or die("Error selecting database: $dbname");

		//echo 'Successfully connected to database!';

		//mysql_close($mysql_handle);

		$dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("ERROR: Could not connect to the database server");
		return $dbc; 
	}

?>


</body>
</html>