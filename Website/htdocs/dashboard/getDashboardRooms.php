<?php
require_once "../src/connect.php";
require_once "../src/classes/PropertyClass.php";
require_once "../src/classes/RoomClass.php";

if (!isset($blockSize))
	$blockSize = 370;

$userID = $_SESSION['user_id'];
    
$properties = [];
    
$properties = Property::getByUserID($userID);

$roomHTML = "";

$count = 0;
    
foreach($properties as $property)
{
	$statement = "SELECT R.dName, R.roomID, RC.occupied, RC.unoccupied, I.icon, R.roomID
				FROM room as R
				INNER JOIN room_colour as RC
				ON R.colourID = RC.colourID
				INNER JOIN icons as I
				ON R.iconID = I.iconID
				INNER JOIN user_room
				ON user_room.roomID = R.roomID
				WHERE R.houseID = $property->houseID
				AND user_room.showRoom = '1'
				AND user_room.userID = $userID";
				
	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			if (strcmp($row['dName'], "Unallocated Sensors") == 0)
			{}
 			else
			{
				$count = $count + 1;
				
				$occupied = Room::occupiedState($row['roomID']);
				
				$state = $occupied[0];
				$colorOCC = $occupied[1];
				
				$color = $row[$colorOCC];
				
				include_once ("{$path}../classes/SensorClass.php");
				
				$sensorHTML = "";
				
				$sensors = [];
	
				$sensors = Sensor::getByRoomID($row['roomID']);
	
				foreach ($sensors as $sensor)
				{
					$sensorHTML .= $sensor->getBlockFormat();
				}
				
				$sensorHTML .= Sensor::getTempFormat($row['roomID']);
				
				if ($count === 1)
				{
					$roomHTML .= "<div class='row'>";
				}		
	
				$roomHTML .= <<<HTML
				
				<div class='col-md-4'>
					<div class='panel panel-{$color}'>
						<div class='panel-heading'>
							<div class='row'>
								<div class='col-xs-3'>
									<i class='fa fa-{$row["icon"]} fa-4x'></i>
								</div>
								<div class='col-xs-9 text-right'>
									<div class='huge' name=''>{$row["dName"]}</div>
									<div>{$state}</div>
								</div>
							</div>
						</div>
						<div class='panel-body'>
							{$sensorHTML}
						</div>
					</div>
				</div>
HTML;
				if ($count === 3)
				{
					$roomHTML .= "</div>";
					$count = 0;
				}
			}
		}
	}
}

if ($count === 0)
{
}
else
{
	$roomHTML .= "</div>";
}

$conn->close();
echo $roomHTML;

?>

<script>
$('.btn-toggle').click(function() {
	$(this).find('.btn').toggleClass('active');

	if ($(this).find('.btn-danger').size()>0) {
		$(this).find('.btn').toggleClass('btn-danger');
	}
	$(this).find('.btn').toggleClass('btn-default');
});

$('form').submit(function(){
	alert($(this["options"]).val());
	return false;
});
</script>