<?php include_once 'header.php'; 
	
	// * WARNING * THIS COULD BE A SECURITY RISK
	if (isset($_SESSION["username"]) && isset($_SESSION["uid"]) && !empty($_SESSION["username"]) && !empty($_SESSION["uid"])) {
		header("Location: editing.php?menu=bites&action=editing");
	}
	// END WARNING
	
	if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
		
		$username = mysqli_real_escape_string($mysqli, strip_tags($_POST["username"]));
		$password = mysqli_real_escape_string($mysqli, strip_tags($_POST["password"]));
				
		$sql = "SELECT uid, username, password FROM users WHERE username=? LIMIT 1";
		$stmt = mysqli_prepare($mysqli, $sql);
		mysqli_stmt_bind_param($stmt, 's', $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $uid, $dbusername, $dbpassword);
		mysqli_stmt_fetch($stmt);
		
		//check username and password are correct
		if ($username == $dbusername && password_verify($password."kingfisher", $dbpassword)) {
			//set session variables
			$_SESSION['username'] = $username;
			$_SESSION['uid'] = $uid;
			
			//now redirect user
			header("Location: editing.php?menu=bites&action=editing");
		} else {
			die( "<h2>Username/password not found. Please try again.</h2>" );
		}
	}	
	
?>

<h2>Admin menu</h2>
<br>
<form action="admin.php" method="POST">
	Username: <input class="input_field" type="text" name="username" style="color: black;" required autofocus><br>
	Password: <input class="input_field" type="password" name="password" style="color: black;"><br>
	<input type="submit" value="Login"  style="color:#cb3737; font-weight: bold;">
</form>

<?php include_once 'footer.php'; ?>