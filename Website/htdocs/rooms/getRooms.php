<?php
	$roomHTML = "";
	require "../src/connect.php";

	require_once "../src/classes/RoomClass.php";
	require_once "../src/classes/SensorClass.php";

	include "../src/includes/functions.php";

	//sec_session_start();
	session_start();
	session_write_close();

	if (isset($_SESSION['house_id']))
	{
		$houseID = $_SESSION['house_id'];

		$rooms = [];

		$rooms = Room::getRoomsByPropertyID($houseID);

		$jsonRooms = array();

		foreach($rooms as $room)
		{
			$sensorData = array();

			$sensors = [];

			$sensors = Sensor::getByRoomID($room->roomID);

			foreach ($sensors as $sensor)
			{
				$sensorData[] = array("count" => $sensor->sensorCount, "sensorHTML" => $sensor->getBlockFormat());
			}

			$userID= $_SESSION['user_id'];

			$showStatement = "SELECT showRoom
				FROM user_room
				WHERE userID = '$userID'
				AND roomID = '$room->roomID'";

			$showResult = $conn->query($showStatement);

			if ($showResult->num_rows > 0)
			{
				$lastSeenRow = $showResult->fetch_assoc();

				$show = $lastSeenRow['showRoom'];
			}
			else
			{
					$show = "0";
			}

			$occupied = Room::occupiedState($room->roomID);

			$state = $occupied[0];

			$jsonRooms[] = array("id" => $room->roomID, "name" => $room->defaultName, "colourUnoccupied" => $room->unoccupiedColour,
								 "colourOccupied" => $room->occupiedColour, "sensorData" => $sensorData, "occupied" => 0, "icon" => $room->icon,
								 "iconID" => $room->iconID, "colourID" => $room->colourID, "show" => $show, "state" => $state);
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