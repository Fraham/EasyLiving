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

function getRoomsSettings()
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
      $roomList .= '<div id="roomsList" class="col-lg-12">
      <div id="room"><span class="drag-handle">&#9776;</span><a style="cursor:pointer;"data-toggle="collapse" data-target="#demo">';
      $roomList.="$row[dName]";

      $roomList.= '</a>
        <div id="demo" class="collapse">
                  <br>
                      Room Name: <input type="text" placeholder="';

    $roomList .="$row[dName]";

    $roomList .='" class="form-control"/>
                      Colour:
            <select class="form-control">
              <option>Red</option>
              <option>Yellow</option>
              <option>Blue</option>
              <option>Green</option>
            </select>
            Icon:
            <select class="form-control">
            </select>
            <button class="btn btn-danger btn-block" data-toggle="collapse" data-target="#demo" style="margin-top:10px;">Confirm</button>
              </div>
            </div>
          </div';
    }
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

  $statement = "SELECT sensors.name, room.dName FROM sensors
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
      if($room == $row["dName"]){       

        $sensorList .= '<div class="col-lg-6">
                          <a href="" class="btn btn-default btn-block" style="margin: 5px;" data-toggle="modal" data-target="#EditModal">';
        $sensorList .="$row[name]";
        $sensorList .='</a> </div>';
      }
    }
  }

  $conn->close();

  return $sensorList;
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
  $roomHTML = "";
  require "../src/connect.php";

  if (isset($_SESSION['house_id']))
  {

    $houseID = $_SESSION['house_id'];

    $statement = "SELECT R.dName, R.roomID, RC.unoccupied
                    FROM room as R
                    INNER JOIN room_colour as RC
                    ON R.colourID = RC.colourID
                    INNER JOIN icons as I
                    ON R.iconID = I.iconID
                    WHERE R.houseID = $houseID";

    $result = $conn->query($statement);
    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $color = $row["unoccupied"];
        $room = $row["dName"];

        $roomHTML .='
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="panel panel-'.$color.'">
                        <div class="panel-heading" >
                        <strong>';
        $roomHTML .="$row[dName]";
        $roomHTML .='</strong>
                        </div>
                        <div class="panel-body"id="chartBody">
                            '.getSensorBtns($room).'
                        </div>
                      </div>
                    </div>';
      }
    }

    $conn->close();
    echo $roomHTML;
  }
  else
  {
    echo "house id not set";
  }
}


?>
