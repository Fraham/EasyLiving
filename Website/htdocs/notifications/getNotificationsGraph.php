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
function getSensorBtns($room)
{
  $sensorList = "";
  require "../src/connect.php";

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
      $sensorList .= '<div class="col-lg-4 col-sm-6">
                        <a href="" class="btn btn-default btn-block" style="margin: 5px;" data-toggle="modal" data-target="#EditModal">';
      $sensorList .="$row[name]";
      $sensorList .='</a> </div>';

    }
  }

  $conn->close();

  echo $sensorList;
}

function getSensorTypes()
{
  $sensorList = "";
  require "../src/connect.php";

  $userID = $_SESSION['user_id'];

  $statement = "SELECT name FROM v_types";

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

function getRoomsAsPanels()
{
  require_once "../src/connect.php";
  $roomHTML = "";

  if (isset($_SESSION['house_id']))
  {

    $houseID = $_SESSION['house_id'];

    $statement = "SELECT R.dName, R.roomID
                    FROM room as R
                    INNER JOIN room_colour as RC
                    ON R.colourID = RC.colourID
                    INNER JOIN icons as I
                    ON R.iconID = I.iconID
                    WHERE R.houseID = $houseID";

    $result = $conn->query($statement);


        $roomHTML .='
                    <div class="col-lg-4">
                      <div class="panel panel-danger">
                        <div class="panel-heading" >
                        <strong>';
        $roomHTML .="$row[dName]";
        $roomHTML .='$</strong>
                        </div>
                        <div class="panel-body"id="chartBody">
                          <?php
                            include("../notifications/getNotificationsGraph.php");
                            getSensorBtns();
                          ?>
                        </div>
                      </div>
                    </div>';

    $conn->close();
    echo $roomHTML;
  }
  else
  {
    echo "house id not set";
  }
}


?>
