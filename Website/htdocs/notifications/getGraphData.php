<?php
require_once "../src/connect.php";

$where = "";
$set = 1;

session_start();
session_write_close();
$userID = $_SESSION['user_id'];

	/*if (isset($_GET["propertyID"]))
	{
	  $propertyID = $_GET["propertyID"];

	  if (strcmp($propertyID, 'Any') !== 0)
	  {
		  if ($set == 0)
		  {
		    $where .= "WHERE ";
		  }
		  else
		  {
		    $where .= " AND  ";
		  }

		  $where .= "house.houseID = ";
		  $where .= $propertyID;

		  $set = 1;
	  }
	}

	if (isset($_GET["roomID"]))
	{
	  $roomID = $_GET["roomID"];

	  if (strcmp($roomID, 'Any') !== 0)
	  {
		  if ($set == 0)
		  {
		    $where .= "WHERE ";
		  }
		  else
		  {
		    $where .= " AND  ";
		  }

		  $where .= "room.roomID = ";
		  $where .= $roomID;

		  $set = 1;
	  }
	}

	if (isset($_GET["sensorID"]))
	{
	  $sensorID = $_GET["sensorID"];

	  if (strcmp($sensorID, 'Any') !== 0)
	  {
		  if ($set == 0)
		  {
		    $where .= "WHERE ";
		  }
		  else
		  {
		    $where .= " AND  ";
		  }

		  $where .= "sensors.sensorID = ";
		  $where .= $sensorID;

		  $set = 1;
	  }
	}*/

	if (isset($_GET["sensorsWhere"]))
	{
	  $where = " AND (" . $_GET['sensorsWhere'] . ")";
	}

	if (isset($_GET["startDate"]))
	{
	  $startDate = $_GET["startDate"];

	  if ($set == 0)
	  {
	    $where .= "WHERE ";
	  }
	  else
	  {
	    $where .= " AND ";
	  }

	  $where .= "log.date >= '";
	  $where .= $startDate;
	  $where .= "'";

	  $set = 1;
	}

	if (isset($_GET["endDate"]))
	{
	  $endDate = $_GET["endDate"];

	  if ($set == 0)
	  {
	    $where .= "WHERE ";
	  }
	  else
	  {
	    $where .= " AND ";
	  }

	  $where .= "log.date <= '";
	  $where .= $endDate;
	  $where .= "'";

	  $set = 1;
	}

$statement = "SELECT log.date, count(*) AS amount, sensors.name as SensorName, log.sensorID FROM log
			INNER JOIN sensors
			ON sensors.sensorID = log.sensorID
			INNER JOIN room
			ON room.roomID = sensors.roomID
			INNER JOIN house
			ON house.houseID = room.houseID
			INNER JOIN user_households
			ON user_households.houseID = house.houseID
			WHERE user_households.userID = '$userID' ";
			$statement .= $where;
			$statement .= " GROUP BY
			  log.sensorID,
				YEAR(log.date),
				MONTH(log.date),
				DAY(log.date),
				HOUR(log.date),
				MINUTE(log.date)";

	$result = $conn->query($statement);

	$jsonRows = array();

	if ($result->num_rows > 0)
	{
	    $check = 0;


	  $jsonResult = array();

	  $lastItem = "";

	  while($row = $result->fetch_assoc())
	  {
	    $sensorID = $row['sensorID'];

	    if (strcmp($sensorID, $lastItem) !== 0)
	    {
	        $lastItem = $row['sensorID'];

	        if ($check == 1)
	        {
				$jsonResult['data'][] = $jsonRows;
	        }

	        $jsonRows = array();

	        $jsonRows['name'] = $row['SensorName'];

	        $check = 1;
	    }


		$year = substr($row['date'], 0, 4);
		$month = substr($row['date'], 5, 2);
		$day = substr($row['date'], 8, 2);
		$hour = substr($row['date'], 11, 2);
		$minute = substr($row['date'], 14, 2);

		$data = array($year, $month, $day, $hour, $minute, 0, $row['amount']);

	    $jsonRows['data'][] = $data;
		$jsonResult['error'] = 0;
	  }
	}
	else
	{
		$jsonResult['error'] = 1;
	}

	$jsonResult['data'][] = $jsonRows;

	print json_encode($jsonResult, JSON_NUMERIC_CHECK);

	$conn->close();
?>
