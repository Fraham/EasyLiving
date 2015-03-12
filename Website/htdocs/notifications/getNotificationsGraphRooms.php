<?php
	$roomList = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";

	sec_session_start();

	$userID = $_SESSION['user_id'];

	//$houseID = $_SESSION['house_id'];

  //$statement = "SELECT dName FROM room WHERE room.houseID = $houseID";

	$statement = "SELECT dName FROM room
								INNER JOIN user_households
								ON user_households.houseID = room.houseID
								WHERE user_households.userID = $userID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$roomList .= "<option>";
      $roomList .= "$row[dName]";
      $roomList .= "</option>";
		}
	}
	else
	{
		$roomList .= "<option>No rooms $userID</option>";
	}

	$conn->close();

	echo $roomList;
?>
