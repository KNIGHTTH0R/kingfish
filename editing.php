<?php require_once 'dbconnect.php'; ?>
<?php
	
	if (isset($_GET['menu']) && !empty($_GET['menu']) && isset($_GET['action']) && !empty($_GET['action'])) {
		$menu = mysqli_real_escape_string($mysqli, strip_tags($_GET['menu']));
		$action = mysqli_real_escape_string($mysqli, strip_tags($_GET['action']));
	} else {
		header("Location: 404.php");
	}

	$url = "editing.php?menu=$menu";


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($action == 'adding') {
			// adding to the database 
			$newname = mysqli_real_escape_string($mysqli, strip_tags($_POST["name"]));
			$newdecs = mysqli_real_escape_string($mysqli, strip_tags($_POST["decs"]));
			$newprice = mysqli_real_escape_string($mysqli, strip_tags($_POST["price"]));
			$newpriority = mysqli_real_escape_string($mysqli, strip_tags($_POST["priority"]));
			$sql = "INSERT INTO $menu (name, `desc`, price, priority) 
					VALUE ('$newname', '$newdecs', '$newprice', '$newpriority')";
			$query = mysqli_query($mysqli, $sql);
			if ($query) {
				echo "<strong>Success:</strong> $sql";
			}

		} else if ($action == 'editing') {
			// editing the database 
			//var_dump($_POST);
			echo "<br>";
			$sql = "SELECT * FROM kingfishlounge.$menu";
			$querys = mysqli_query($mysqli, $sql);
			switch ($menu) {
				case 'bites': $id = 'bid'; break;
				case 'drinks': $id = 'did'; break;
				default: header("Location: 404.php");
			} 

			while ($row = mysqli_fetch_assoc($querys)) {
				$newname = mysqli_real_escape_string($mysqli, strip_tags($_POST["name_" . $row[$id]]));
				$newdecs = mysqli_real_escape_string($mysqli, strip_tags($_POST["decs_" . $row[$id]]));
				$newprice = mysqli_real_escape_string($mysqli, strip_tags($_POST["price_" . $row[$id]]));
				$newpriority = mysqli_real_escape_string($mysqli, strip_tags($_POST["priority_" . $row[$id]]));

				$sqls = "UPDATE $menu
						 SET name='$newname', `desc`='$newdecs', price='$newprice', priority='$newpriority'
						 WHERE $id=$row[$id]";
				$edited = mysqli_query($mysqli, $sqls);
				//echo $sql . "<br>";
				if ($edited) {
					echo "<strong>Success:</strong> " . $sqls . "<br>";
				}
			}

			//var_dump($_POST);
			
				
			


		} else if ($action == 'deleting') { 
			// deleting from the database 
			switch ($menu) {
				case 'bites': $id = 'bid'; break;
				case 'drinks': $id = 'did'; break;
				default: header("Location: 404.php");
			} 
			$todelete = mysqli_real_escape_string($mysqli, strip_tags($_POST["delete"]));
			$todelete = explode(" ", $todelete)[1];
			$sql = "DELETE FROM $menu
					 WHERE $id='$todelete' ";
			$query = mysqli_query($mysqli, $sql);
			if ($query) {
				echo "<strong>Success:</strong> $sql";
			}

		} else {
			echo "none";
		}
	}



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

		.toprow {
			font-weight: bold;
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
		
		echo "<form action='$url&action=editing' method='POST'>";
		echo "<table>";
		echo "<tr class='toprow'><td>ID</td> <td>Name</td> <td>Description</td> <td>Price</td> <td>Priority</td> <td></td></tr>";
		while ($row = mysqli_fetch_assoc($query)) {
			$rid = $row["$id"];
			$name = $row['name'];
			$desc = $row['desc'];
			$price = $row['price'];
			$priority = $row['priority'];
			echo "<tr>";
			echo "<td><label>$rid</label>";
			echo "<td><input type='text' name='name $rid' value='$name'></td>";
			echo "<td><input type='text' name='decs $rid' value='$desc'></td>";
			echo "<td><input type='number' name='price $rid' value='$price'></td>";
			echo "<td><input type='number' name='priority $rid' value='$priority'></td>";
			echo "</tr>";
		}
		
		echo "<tr><td><input type='submit'><tf></tr>";
		echo "</table";
		echo "</form>";

	} else if ($action == 'adding') {
		// This is the add form 
		echo "<form action='$url&action=adding' method='POST''>";
			echo "<input type='text' name='name'>";
			echo "<input type='text' name='decs'>";
			echo "<input type='number' name='price'>";
			echo "<input type='number' name='priority'>";
			echo "<input type='submit' value='add'>";
		echo "</form>";

	} else if ($action == 'deleting') {
		$sql = "SELECT * FROM kingfishlounge.$menu";
		$query = mysqli_query($mysqli, $sql);
		
		echo "<form action='$url&action=deleting' method='POST'>";
		echo "<table>";
		echo "<tr class='toprow'><td>ID</td> <td>Name</td> <td>Description</td> <td>Price</td> <td>Priority</td> <td></td></tr>";
		while ($row = mysqli_fetch_assoc($query)) {
			switch ($menu) {
				case 'bites': $id = 'bid'; break;
				case 'drinks': $id = 'did'; break;
				default: header("Location: 404.php");
			}
			$rid = $row["$id"];
			$name = $row['name'];
			$desc = $row['desc'];
			$price = $row['price'];
			$priority = $row["priority"];

			echo "<tr> <td> $rid </td><td> $name </td><td> $desc </td><td> $price </td><td> $priority</td><td>  <input type='submit' name=delete value='delete $rid'> </td></tr>";
		}
		echo "</table";
		echo "</form>";
	}

?>


</body>
</html>