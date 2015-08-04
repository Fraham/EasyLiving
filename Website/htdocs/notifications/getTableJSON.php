<?php
	include "../src/includes/functions.php";
	
	require_once "../src/connect.php";
	
	$where = "";
	$set = 1;

session_start();
session_write_close();
$userID = $_SESSION['user_id'];
	
	if (isset($_GET["propertyID"]))
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
		WHERE user_households.userID = '$userID'";
	$statement .= $where;
	$statement .= " ORDER BY logID DESC";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$state = (int) $row["state"];
			$message = "";

			if($state == 0)
			{
				$message = $row['messageOff'];
			}
			else
			{
				$message = $row['messageOn'];
			}
			
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

	echo json_encode($jsonRows, JSON_NUMERIC_CHECK);

	$conn->close();
	
?>