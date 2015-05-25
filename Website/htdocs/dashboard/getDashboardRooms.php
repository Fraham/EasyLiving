<?php
require_once "../src/connect.php";
require_once "../src/classes/PropertyClass.php";

if (!isset($blockSize))
	$blockSize = 370;

$userID = $_SESSION['user_id'];
    
$properties = [];
    
$properties = Property::getByUserID($userID);

$roomHTML = "";
    
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
				$occupiedStatement = "SELECT state, sensorID FROM sensors
					INNER JOIN room
					ON sensors.roomID = room.roomID
					WHERE room.roomID = $row[roomID]";
	
				$occupiedResult = $conn->query($occupiedStatement);
	
				$motion = 0;
	
				if ($occupiedResult->num_rows > 0)
				{
					while($occupiedRow = $occupiedResult->fetch_assoc())
					{
						if (0 === strpos($occupiedRow['sensorID'], '01'))
			            {
			                if ($occupiedRow['state'] == 1)
			                {
			                    $motion = 1;
			                }
			            }
					}
				}
	
				if ($motion == 1) //motion sensor state
				{
					$color = $row["occupied"];
					$state = "Occupied";
				}
				else
				{
					$color = $row["unoccupied"];
					
					$lastSeenStatement = "SELECT date 
					FROM log
					INNER JOIN sensors
					On sensors.sensorID = log.sensorID
					INNER JOIN room
					ON sensors.roomID = room.roomID
					WHERE room.roomID = $row[roomID] and sensors.sensorID LIKE '01%'
					ORDER BY logID DESC
					LIMIT 1";
					
					$lastSeenResult = $conn->query($lastSeenStatement);
					
					if ($lastSeenResult->num_rows > 0)
					{
						$lastSeenRow = $lastSeenResult->fetch_assoc();
						
						$state = "Motion last detected at: ";
						
						$theDate = strtotime($lastSeenRow['date']);
						
						$state .= date("h:ia l d", $theDate);
					}
					else
					{
						$state = "No motion sensor detected";
					}			
				}
				
				include_once ("{$path}../classes/SensorClass.php");
				
				$sensorHTML = "";
				
				$sensors = [];
	
				$sensors = Sensor::getByRoomID($row['roomID']);
	
				foreach ($sensors as $sensor)
				{
					$sensorHTML .= $sensor->getBlockFormat();
				}			
	
				$roomHTML .= <<<HTML
				<div class='col-lg-2 room-xs' style='width: {$blockSize}px; margin: auto; float: none;display: inline-block;'>
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
			}
		}
	}
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