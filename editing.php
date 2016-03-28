<?php require_once 'dbconnect.php'; ?>
<?php
	
	if (isset($_GET['menu']) && !empty($_GET['menu']) && isset($_GET['action']) && !empty($_GET['action'])) {
		$menu = mysqli_real_escape_string($mysqli, strip_tags($_GET['menu']));
		$action = mysqli_real_escape_string($mysqli, strip_tags($_GET['action']));
	} else {
		header("Location: 404.php");
	}

	$url = "editing?menu=$menu";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Editing the <?php echo $menu; ?></title>
</head>
<body>


<?php
	
	$actions = ['editing', 'adding', 'deleting'];
	switch ($action) {
		case 'editing': 
		case 'adding':
		case 'deleting': 
			echo "<h1>".ucfirst($action)."</h1>";
			echo "<nav>";
			foreach ($actions as $oaction) {
				if ($action != $oaction) {
					echo "<a href='$url&action=$oaction'>$oaction</a>";
				} else {
					echo "<span class='selected_action'>$action</span>";
				}	
			}
			echo "</nav>";
			echo "<hr>";
			break;
		default: header("Location: 404.php");
	}


	if ($action == 'editing') {
		// This form is for edditing
		$dbc = $mysqli;
		$menu = mysqli_real_escape_string($mysqli, strip_tags($_GET['menu']));
		switch ($menu) {
			case 'bites': $id = 'bid'; break;
			case 'drinks': $id = 'did'; break;
			default: header("Location: 404.php");
		}
		$sql = "SELECT * FROM kingfishlounge.".$_GET['menu']."";
		$query = mysqli_query($dbc, $sql);
		
		echo "<form action='editting.php?menu=".$_GET['menu']."&action=editing' method='POST'>";
		while ($row = mysqli_fetch_assoc($query)) {
			echo "<label>" . $row["$id"] . "</label>";
			echo "<input type='text' name='name" . $row["$id"] . "' value='" . $row['name'] ."'>";
			echo "<input type='text' name='decs" . $row["$id"] . "' value='" .$row['desc'] . "'>";
			echo "<input type='text' name='price" . $row["$id"] . "' value='" . $row['price'] . "'><br>";
		}
		echo "<input type='submit'>";
		echo "</form>";
	} else if ($action == 'adding') {
		// This is the add form 
		echo "<form action='editting.php?menu=bites&action=adding' method='POST''>";
			echo "<input type='text' name='name'>";
			echo "<input type='text' name='decs'>";
			echo "<input type='text' name='price'>";
			echo "<input type='submit' value='add'";
		echo "</form>";
	} else if ($action == 'deleting') {
		// This is the form for deleting
	}

?>


</body>
</html>