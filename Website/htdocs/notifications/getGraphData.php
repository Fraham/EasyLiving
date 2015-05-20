<?php
require_once "../src/connect.php";

$where = "";
$set = 0;

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

$statement = "SELECT log.date, count(*) AS amount, sensors.name as SensorName, log.sensorID FROM log
INNER JOIN sensors
ON sensors.sensorID = log.sensorID
INNER JOIN room
ON room.roomID = sensors.roomID
INNER JOIN house
ON house.houseID = room.houseID ";
$statement .= $where;
$statement .= " GROUP BY
  log.sensorID,
	YEAR(log.date),
	MONTH(log.date),
	DAY(log.date),
	HOUR(log.date)";

$result = $conn->query($statement);

if ($result->num_rows > 0)
{
    $check = 0;

  $jsonRows = array();

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
			$jsonResult[] = $jsonRows;
        }

        $jsonRows = array();

        $jsonRows['name'] = $row['SensorName'];

        $check = 1;
    }
	
	$year = substr($row['date'], 0, 4);
	$month = substr($row['date'], 5, 2);
	$day = substr($row['date'], 8, 2);
	$hour = substr($row['date'], 11, 2);
	
	$data = array($year, $month, $day, $hour, 0, 0, $row['amount']);

    $jsonRows['data'][] = $data;
  }
}

$jsonResult[] = $jsonRows;

print json_encode($jsonResult, JSON_NUMERIC_CHECK);

$conn->close();
?>
