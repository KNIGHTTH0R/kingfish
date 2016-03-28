<?php

	function getdbc() {
		// $dbhost = 'mysql.kingfishcorvallis.com'; 
		// $dbname = 'kingfishlounge';
		// $dbuser = 'kingfishlounger@ip-208-113-156-25.dreamhost.com';
		// $dbpass = 'squirrelfish5!~';
		
		$dbhost = 'mysql.kingfishcorvallis.com'; 
		$dbname = 'kingfishlounge';
		$dbuser = 'kingfishlounger';
		$dbpass = 'squirrelfish5!~';

		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Could not connect to database");
		return $mysqli; 
	}

	$adding = False;
	$editing = False;
	$deleting = False;
	$url = "http://www.kingfishcorvallis.com/editting?menu=".$_GET['menu'];


	if (!isset($_GET['action'])) {
		header("Location: ". $url ."&action=editing");
	} else if ($_GET['action'] == 'adding') {
		$adding = True;
	} else if ($_GET['action'] == 'editing') {
		$editing = True;
	} else if ($_GET['action'] == 'deleting') {
		$deleting = True;
	}

	function topbit() {
		if ($editing) {
			echo "<h1>Editing</h1>";
		}
		if ($adding) {
			echo "<h1>Adding</h1>";
		}
		if ($deleting) {
			echo "<h1>Deleting</h1>";
		}
	
		echo "<nav>";

		if ($editing) {
			echo "<span class='selected_action'>Edit</span>";
		} else {
			echo "<a href=".$url."&action=editing>Edit</a>";
		}
		if ($adding) {
			echo "<span class='selected_action'>Add</span>";
		} else {
			echo "<a href=".$url."&action=adding>Add</a>";
		}

		if ($deleting) {
			echo "<span class='selected_action'>Delete</span>";
		} else {
			echo "<a href=".$url."&action=deleting>Delete</a>";
		}

		echo "</nav>";

		echo "<hr>";
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Editing the <?=$_GET["menu"]?></title>
</head>
<body>


<?php

	// $dbhost = 'mysql.kingfishcorvallis.com'; 
	// $dbname = 'kingfishlounge';
	// $dbuser = 'kingfishlounger';
	// $dbpass = 'squirrelfish5!~';


	topbit();


	if ($editting) {
		// This form is for edditing
		$dbc = getdbc();
		$sql = "SELECT * FROM kingfishlounge.".$_GET['menu']."";
		$query = mysqli_query($dbc, $sql);
		
		echo "<form action='editting.php?menu=".$_GET['menu']."&action=editing' method='POST'>";
		while ($row = mysqli_fetch_assoc($query)) {
			echo "<label>" . $row['id'] . "<label>"
			echo "<input type='text' name='name" . $row['id'] . "' value='" . $row['name'] ."'>";
			echo "<input type='text' name='decs" . $row['id'] . "' value='" .$row['desc'] . "'>";
			echo "<input type='text' name='price" . $row['id'] . "' value='" . $row['price'] . "'><br>";
		}
		echo "<input type='submit'>"
		echo "</form>";
	}

	if ($adding) {
		// This is the add form 
		echo "<form action='editting.php?menu=bites&action=adding' method='POST''>";
			echo "<input type='text' name='name'>";
			echo "<input type='text' name='decs'>";
			echo "<input type='text' name='price'>";
			echo "<input type='submit' value='add'";
		echo "</form>";
	}

	if ($deleting) {
		// This is the form for deleting
	}


	
	

?>


</body>
</html>