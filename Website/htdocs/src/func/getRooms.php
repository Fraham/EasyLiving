<?php
$roomHTML = "";
require_once "../connect.php";

$houseID = "111111";

$statement = "SELECT dName, colourID, iconID FROM room WHERE room.houseID = $houseID";

$result = $conn->query($statement);

$count = 0;

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $count++;

    $roomStatement = "SELECT occupied, unoccupied, icon FROM icons, room_colour
    WHERE icons.iconID = $row[iconID]
    AND colourID = $row[colourID]";

    $roomResult = $conn->query($roomStatement);

    if ($roomResult->num_rows > 0)
    {
      $innerRow = $roomResult->fetch_assoc();

      $roomHTML .= "<div class='col-lg-6 col-md-6'>
      <div class='panel panel-";
      $roomHTML .= "$innerRow[occupied]";
      $roomHTML .= "'>
      <div class='panel-heading'>
      <div class='row'>
      <div class='col-xs-3'>
      <i class='fa";

      $roomHTML .= " $innerRow[icon] ";

      $roomHTML .= "fa-4x'></i>
      </div>
      <div class='col-xs-9 text-right'>
      <div class='huge'>";

      $roomHTML .= "$row[dName]";

      $roomHTML .= "</div>
      <div>Occupied</div>
      </div>
      </div>
      </div>
      <div class='panel-body'>
      <div class='col-md-6'>
      <h4><font color='black'>Window: </font><span class='text-danger'>Open</span></h4>
      </div>
      <div class='col-md-6'>
      <h4>Lamp:
      <span><div class='btn-group btn-toggle'>
      <button class='btn btn-xs btn-default'>ON</button>
      <button class='btn btn-xs btn-danger active'>OFF</button>
      </span>
      </h4>
      </div>
      </select>
      </div>
      </div>
      </div>
      </div>";
    }

    if ($count == 2)
    {
      $roomHTML .= "<div class='clearfix'></div>";
      $count = 0;
    }
  }
}

$conn->close();
echo $roomHTML;
?>
