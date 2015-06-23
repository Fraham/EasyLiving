<?php
	if (isset($_POST["func"]) and isset($_POST["houseID"]) and isset($_POST["user_id"]))
	{
		include "../includes/functions.php";
		
		require "../connect.php";
	
		//sec_session_start();
	session_start();
		
		$houseID = $_POST["houseID"];
		
		$userID = $_POST['user_id'];
		
		$_SESSION['house_id'] = $houseID;
		
		$statement = "UPDATE users 
					SET `currentHousehold`='$houseID'
					WHERE `userID`='$userID'";

		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
	}	
?>