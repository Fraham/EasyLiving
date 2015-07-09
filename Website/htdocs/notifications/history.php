<?php
	if(isset($_POST['action']) && !empty($_POST['action'])) 
	{
	    $action = $_POST['action'];
	    switch($action) 
		{
	        case 'updateSensorsList' : updateSensorsList();break;
	    }
	}
	
	function updateSensorsList()
	{
		require "../src/connect.php";
		
		session_start();

		$userID = $_SESSION['user_id'];
	
		$where = " WHERE user_households.userID = ";
		$where .= $userID;
	
		if(isset($_POST['propertyID']) && isset($_POST['roomID']))
		{
			$propertyID = $_POST['propertyID'];
			$roomID = $_POST['roomID'];
			
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
	
		$statement = "SELECT sensors.name, sensorID FROM sensors
		INNER JOIN room
		ON room.roomID = sensors.roomID
		INNER JOIN user_households
		ON user_households.houseID = room.houseID";  
		$statement .= $where;
	}
?>