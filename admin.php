<?php include_once 'header.php'; 
	
	if (isset($_POST['username'])) {
		
		require_once 'password.php';
		
		$username = strip_tags($_POST["username"]);
		$password = strip_tags($_POST["password"]);
		
		$username = mysqli_real_escape_string($mysqli, $username);
		$password = mysqli_real_escape_string($mysqli, $password);
		
		$sql = "SELECT uid, username, password FROM users WHERE username='$username' LIMIT 1";
		$query = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_row($query);
		
		$uid = $row[0];
		
		$dbusername = $row[1];
		
		$dbpassword = $row[2];
		
		echo "HI";
		//check username and password are correct
		//if ($username == $dbUsername && password_verify($password."winkleer", $dbPassword)) {
		if ($username == $dbusername && md5($password) == $dbpassword) {
			//set session variables
			echo "HI";
			$_SESSION['username'] = $username;
			$_SESSION['uid'] = $uid;
			
			//now redirect user
			header("Location: editing.php?menu=bites&action=editing");
			echo "AHHHH";
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