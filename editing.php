<?php require_once 'dbconnect.php'; ?>
<?php
	
	if (isset($_GET['menu']) && !empty($_GET['menu']) && isset($_GET['action']) && !empty($_GET['action'])) {
		$menu = mysqli_real_escape_string($mysqli, strip_tags($_GET['menu']));
		$action = mysqli_real_escape_string($mysqli, strip_tags($_GET['action']));
	} else {
		header("Location: 404.php");
	}

	$url = "editing?menu=$menu&action=editing";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Editing the <?php echo ucfirst($menu); ?></title>
	<style type="text/css" media="screen">
		nav a, nav span {
			padding-right: 5px;
		}
		
		.selected_action {
			font-weight: bold;
		}
		
		.other_action {
			color: #cb3737;
		}
	</style>
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
					echo "<a href='$url&action=$oaction' class='other_action'>$oaction</a>";
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
		$sql = "SELECT * FROM kingfishlounge.$menu";
		$query = mysqli_query($dbc, $sql);
		
		echo "<form action='editting.php?menu=$menu&action=editing' method='POST'>";
		while ($row = mysqli_fetch_assoc($query)) {
			$rid = $row["$id"];
			$name = $row['name'];
			$desc = $row['desc'];
			$price = $row['price'];
			
			echo "<label>$rid</label>";
			echo "<input type='text' name='name$rid' value='$name'>";
			echo "<input type='text' name='decs$rid' value='$desc'>";
			echo "<input type='text' name='price$rid' value='$price'><br>";
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