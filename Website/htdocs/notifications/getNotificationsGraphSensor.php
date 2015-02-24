<?php
	$sensorList = "";
	require "../src/connect.php";

  $houseID = "111111";

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
