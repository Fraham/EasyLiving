<?php 
	require_once "../src/connect.php";
	include "../src/classes/roomClass.php";
	
	include "../src/includes/functions.php";

	sec_session_start();

	$roomID = $_POST['roomID'];
	$roomName = $_POST['name'];
	$roomColour = $_POST['colour'];
	$roomIcon = $_POST['icon'];
	
	$userID = $_SESSION['user_id'];
	
	if (isset($_POST['show']))
	{
		$showRoom = "1";
	}
	else
	{
		$showRoom = "0";
	}

	echo Room::updateRoom($roomID, $roomName, $roomColour, $roomIcon);
	
	$showStatement = "SELECT * 
				FROM user_room
				WHERE userID = '$userID'
				AND roomID = '$roomID'";
				
				$showResult = $conn->query($showStatement);
				
				if ($showResult->num_rows > 0)
				{
					$statement = "UPDATE user_room 
								SET showRoom = '$showRoom'
								WHERE userID = '$userID' 
								AND roomID = '$roomID'";
								
					if (!$conn->query($statement)) {
						echo "Error: " . $statement . "<br>" . $conn->error;
					}
				}
				else
				{
					$statement = "INSERT INTO user_room 
								(userID, roomID, showRoom) 
								VALUES ('$userID', '$roomID', '$showRoom')";
					if (!$conn->query($statement)) {
						echo "Error: " . $statement . "<br>" . $conn->error;
					}
				}
				
?>