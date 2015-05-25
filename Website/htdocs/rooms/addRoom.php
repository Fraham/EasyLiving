<?php
	include "../src/includes/functions.php";

	sec_session_start();
	
	$dName = $_POST["name"];
	$houseID = $_SESSION['house_id'];
	$colourID = $_POST['colour'];
	$iconID = $_POST['icon'];
	
	if (isset($_POST['show']))
	{
		$showRoom = "1";
	}
	else
	{
		$showRoom = "0";
	}
	
	$userID = $_SESSION['user_id'];
	
	require "../src/connect.php";	

	$statement = "INSERT INTO room 
				(dName, houseID, colourID, iconID) 
				VALUES ('$dName', '$houseID', '$colourID', '$iconID')";
				
	if (!$conn->query($statement)) {
		echo "Error: " . $statement . "<br>" . $conn->error;
	}
	
	$roomID = mysqli_insert_id($conn);
	
	$statement = "INSERT INTO user_room 
				(userID, roomID, showRoom) 
				VALUES ('$userID', '$roomID', '$showRoom')";
	if (!$conn->query($statement)) {
		echo "Error: " . $statement . "<br>" . $conn->error;
	}
	
	$conn->close();	
?>