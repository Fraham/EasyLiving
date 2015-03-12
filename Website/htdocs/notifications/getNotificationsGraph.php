<?php
function getProperties()
{
  $propertyList = "";

  require "../src/connect.php";

  $userID = $_SESSION['user_id'];

  $statement = "SELECT houseName FROM user_households WHERE user_households.userID =  $userID";

  $result = $conn->query($statement);

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
      $propertyList .= "<option>";
      $propertyList .= "$row[houseName]";
      $propertyList .= "</option>";
    }
  }

  $conn->close();

  return $propertyList;
}

function getRooms()
{
  $roomList = "";
  require "../src/connect.php";

  $userID = $_SESSION['user_id'];

  //$houseID = $_SESSION['house_id'];

  //$statement = "SELECT dName FROM room WHERE room.houseID = $houseID";

  $statement = "SELECT dName FROM room
                INNER JOIN user_households
                ON user_households.houseID = room.houseID
                WHERE user_households.userID = $userID";

  $result = $conn->query($statement);

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
      $roomList .= "<option>";
      $roomList .= "$row[dName]";
      $roomList .= "</option>";
    }
  }
  else
  {
    $roomList .= "<option>No rooms $userID</option>";
  }

  $conn->close();

  echo $roomList;
}

function getSensors()
{
  $sensorList = "";
  require "../src/connect.php";

  //$houseID = $_SESSION['house_id'];

  $userID = $_SESSION['user_id'];

  $statement = "SELECT sensors.name FROM sensors
  INNER JOIN room
  ON room.roomID = sensors.roomID
  INNER JOIN user_households
  ON user_households.houseID = room.houseID
  WHERE user_households.userID = $userID";

  $result = $conn->query($statement);

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
      $sensorList .= "<option>";
      $sensorList .= "$row[name]";
      $sensorList .= "</option>";
    }
  }

  $conn->close();

  echo $sensorList;
}

//include "../src/includes/functions.php";

//sec_session_start();
/*
getProperties();

getRooms();

getSensors();*/

?>
