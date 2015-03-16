<?php
require_once "../src/connect.php";

//$userID = $_SESSION['user_id'];

$where = "";
$set = 0;

if (isset($_GET["propertyID"]))
{
  $propertyID = $_GET["propertyID"];

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

if (isset($_GET["roomID"]))
{
  $roomID = $_GET["roomID"];

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

if (isset($_GET["sensorID"]))
{
  $sensorID = $_GET["sensorID"];

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

/*if (isset($_GET["startDate"]))
{
  $startDate = $_GET["startDate"];

  if ($set == 0)
  {
    $where .= "WHERE";
  }
  else
  {
    $where .= "AND ";
  }

  $where .= "log.date = ";
  $where .= $propertyID;

  $set = 1;
}

if (isset($_GET["endDate"]))
{
  $endDate = $_GET["endDate"];

  if ($set == 0)
  {
    $where .= "WHERE";
  }
  else
  {
    $where .= "AND ";
  }

  $where .= "house.houseID = ";
  $where .= $propertyID;

  $set = 1;
}*/

$statement = "SELECT log.date, count(*) as Amount FROM log
INNER JOIN sensors
ON sensors.sensorID = log.sensorID
INNER JOIN room
ON room.roomID = sensors.roomID
INNER JOIN house
ON house.houseID = room.houseID ";
$statement .= $where;
$statement .= " GROUP BY
	YEAR(log.date),
	MONTH(log.date),
	DAY(log.date),
	HOUR(log.date)";

$result = $conn->query($statement);

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    echo $row['date'] . "\t" . $row['Amount']. "\r\n";
  }
}

$conn->close();
?>
