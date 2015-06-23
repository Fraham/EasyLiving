<?php
	$roomHTML = "";
	require "../src/connect.php";
	
	require_once "../src/classes/RoomClass.php";
	require_once "../src/classes/SensorClass.php";
	
	include "../src/includes/functions.php";

	//sec_session_start();
	session_start();

	if (isset($_SESSION['house_id']))
	{
		$houseID = $_SESSION['house_id'];
		
		$rooms = [];
		
		$rooms = Room::getRoomsByPropertyID($houseID);
		
		$jsonRooms = array();
		
		foreach($rooms as $room)
		{
			//get sensor data
			$sensorData = getSensorBtns($room->roomID);
			$jsonRooms[] = array("name" => $room->defaultName, "colour" => $room->unoccupiedColour, "sensorData" => $sensorData); 
		}

		
		$jsonResult['message'] = "okay";
		$jsonResult['data'] = $jsonRooms;
		$conn->close();
	}
	else
	{
		$jsonResult['message'] = "house ID not set";
	}	
	
	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
	
function getSensorBtns($roomID)
{
	$sensorList = "";
	require "../src/connect.php";

	$statement = "SELECT sensors.roomID, sensors.name, sensors.messageOn, sensors.messageOff, sensors.sensorID, room.dName 
	FROM sensors
	INNER JOIN room
	ON room.roomID = sensors.roomID
	WHERE room.roomID = '$roomID'";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		$count = 0;
		while($row = $result->fetch_assoc())
		{
			$sensorList .= <<<HTML
			<div class="col-lg-6">
				<a class="btn btn-default btn-block" style="margin: 5px;" onClick="openForm('{$row['sensorID']}', '{$row['name']}', '{$row['messageOn']}', '{$row['messageOff']}', '{$row['roomID']}')">{$row["name"]}</a>
			</div>
HTML;
			$count++;
		}
	}

	$conn->close();

	return $sensorList;
}
?>