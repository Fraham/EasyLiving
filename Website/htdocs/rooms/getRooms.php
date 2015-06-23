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
			//$sensorData = getSensorBtns($room->roomID);
			$sensorData = "";
			$jsonRooms[] = array("id" => $room->roomID, "name" => $room->defaultName, "colourUnoccupied" => $room->unoccupiedColour, "colourOccupied" => $room->occupiedColour, "sensorData" => $sensorData, "occupied" => 0); 
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
?>