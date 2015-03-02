<?php
	$sensorList = "";
	require "../src/connect.php";

	$houseID = $_SESSION['house_id'];

  $statement = "SELECT sensors.name FROM sensors
	INNER JOIN room
	ON room.roomID = sensors.roomID
	WHERE room.houseID = $houseID";

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
