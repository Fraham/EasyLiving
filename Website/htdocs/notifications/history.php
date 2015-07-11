<?php
	if(isset($_GET['action']) && !empty($_GET['action']))
	{
	    $action = $_GET['action'];
	    switch($action)
		{
	        case 'updateSensorsList' : updateSensorsList();break;
			case 'updateRoomsList' : updateRoomsList();break;
			case 'updatePropertyList' : updatePropertyList();break;
			//case default : updateSensorsList();break;
	    }
	}

	function updateSensorsList()
	{
		require "../src/connect.php";
		include "../src/classes/SensorClass.php";

		$where = "";

		session_start();


		session_write_close();

		$userID = $_SESSION['user_id'];

		$where = " WHERE user_households.userID = ";
		$where .= $userID;

		if(isset($_GET['propertyID']) && isset($_GET['roomID']))
		{
			$propertyID = $_GET['propertyID'];
			$roomID = $_GET['roomID'];

			if ($propertyID !== "Any")
			{
				$where .= " AND room.houseID = ";
				$where .= $propertyID;
			}
			if ($roomID !== "Any")
			{
				$where .= " AND sensors.roomID = ";
				$where .= $roomID;
			}
		}

		$statement = "SELECT sensors.name, sensorID, messageOn, messageOff, sensors.roomID , sensors.state
					FROM sensors
					INNER JOIN room
					ON room.roomID = sensors.roomID
					INNER JOIN user_households
					ON user_households.houseID = room.houseID";
		$statement .= $where;

		$sensors = Sensor::getFromQuery($statement);

		foreach($sensors as $sensor)
		{
			$jsonResult['data'][] = array("sensorID" => $sensor->sensorID, "name" => $sensor->name);
		}

		echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
	}

	function updateRoomsList()
	{
		include "../src/classes/RoomClass.php";

		$jsonResult;
		$rooms;

		if(isset($_GET['propertyID']))
		{
			$propertyID = $_GET['propertyID'];

			$rooms = Room::getRoomsByPropertyID($propertyID);
		}
		else
		{
			$rooms = Room::getRoomsByPropertyID();
		}

		foreach($rooms as $room)
		{
			$jsonResult['data'][] = array("roomID" => $room->roomID, "defaultName" => $room->defaultName);
		}

		echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
	}

	function updatePropertyList()
	{
		require "../src/connect.php";
		include "../src/classes/PropertyClass.php";

		session_start();

		session_write_close();

		$userID = $_SESSION['user_id'];

		$properties = Property::getByUserID($userID);

		foreach($properties as $property)
		{
			$jsonResult['data'][] = array("houseID" => $property->houseID, "userName" => $property->userName);
		}

		echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
	}
?>