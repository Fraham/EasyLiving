<?php
	$sensorList = "";
	require "../src/connect.php";

	//$houseID = $_SESSION['house_id'];

	$userID = $_SESSION['user_id'];

  $statement = "SELECT sensors.name FROM sensors
	INNER JOIN room
	ON room.roomID = sensors.roomID
	INNER JOIN user_households
	ON user_households.houseID = room.houseID
	WHERE user_households.userID = $userID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$sensorList .= "<option>";
      $sensorList .= "$row[name]";
      $sensorList .= "</option>";
		}
	}

	$conn->close();

	echo $sensorList;
?>
