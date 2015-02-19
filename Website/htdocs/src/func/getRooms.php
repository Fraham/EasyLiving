<?php
    $roomHTML = "";
    require_once "../connect.php";

    $statement = "SELECT dName FROM room";
    //WHERE room.houseID = $houseID";

    $result = $conn->query($statement);

    $count = 0;

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $count++;
        $roomHTML .= "<div class='col-lg-6 col-md-6'>
            <div class='panel panel-red'>
            <div class='panel-heading'>
            <div class='row'>
            <div class='col-xs-3'>
            <i class='fa fa-comments fa-4x'></i>
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
            <h4>Lamp: **Switch**</h4>
            <select name='slider' id='flip-a' data-role='slider'>
            <option value='off'>Off</option>
            <option value='on'>On</option>
            </select>
            </div>
            </div>
            </div>
            </div>";

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
