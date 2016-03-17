<?php include_once 'header.php'; ?>
<!-- header.php: <html> <head> <body> -->

	<div class="imageContainer">
		<img id="landingImage" src="img/lights.png">
	</div>
	
	<?php
		
		$sql = "SELECT * FROM kingfishlounge.bites";
		$query = mysqli_query($mysqli, $sql);
		
		echo "<ul id='bites_menu'>";
		while ($row = mysqli_fetch_assoc($query)) {
			echo "<li>".$row['name']." | ".$row['desc']." | $".$row['price']."</li>";
		}
		echo "</ul>"
				
	?>

<!-- footer.php: JavaScript includes </body> </html> -->
<?php include_once 'footer.php'; ?>
