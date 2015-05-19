<?php
  $title = "Sensors";
  $path = "../src/templates/";
  include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
	<?php 
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$ID = $_POST['sensorID'];
		require "../src/connect.php";

		$userID = $_SESSION['user_id'];
			$statement = "DELETE FROM sensors WHERE sensorID = '$ID'";
			if ($conn->query($statement) === TRUE){}
		$conn->close();
	}
	




}

?>


	<?php
		include $path."footer.php"
	?>
  
<?php else : ?>
<?php endif; ?>