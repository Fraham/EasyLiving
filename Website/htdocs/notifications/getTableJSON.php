<?php
	include "../src/includes/functions.php";

	require_once "../src/connect.php";

	$where = "";
	$set = 1;

	session_start();
	session_write_close();
	$userID = $_SESSION['user_id'];

	if (isset($_GET["sensorsWhere"]))
	{
	  $where = " AND (" . $_GET['sensorsWhere'] . ")";
	}

	if (isset($_GET["startDate"]))
	{
	  $startDate = $_GET["startDate"];

	  $where .= " AND " . "log.date >= '" . $startDate . "'";
	}

	if (isset($_GET["endDate"]))
	{
		$endDate = $_GET["endDate"];

	  	$where .= " AND " . "log.date <= '" . $endDate . "'";
	}

	$statement = "SELECT room.dName, DATE_FORMAT(log.date,'%d %M %Y %T') as time, sensors.name  as sensorName, sensors.messageOn, sensors.messageOff, log.state
		FROM log
		INNER JOIN sensors
		ON log.sensorID = sensors.sensorID
		INNER JOIN room
		ON sensors.roomID = room.roomID
		INNER JOIN house
		ON room.houseID = house.houseID
		INNER JOIN user_households
		ON user_households.houseID = house.houseID
		WHERE user_households.userID = '$userID'" . $where . " ORDER BY logID DESC";


	$result = $conn->query($statement);

	$jsonRows = array();

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$state = (int) $row["state"];
			$message = ($state == 0 ? $row['messageOff'] : $row['messageOn']);

			$data = array($row['dName'], $row['sensorName'], $message, $row['time']);

    		$jsonRows[] = $data;
		}

		$jsonResult["error"] = 0;
	}
	else
	{
		$jsonResult["error"] = 1;
	}

	$jsonResult["data"] = $jsonRows;

	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);

	$conn->close();

?>