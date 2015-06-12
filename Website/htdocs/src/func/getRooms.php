<?php
require_once "{$path}../connect.php";
require_once "{$path}../classes/RoomClass.php";
$roomHTML = "";

if (!isset($blockSize))
	$blockSize = 370;
	
$count = 0;

if (isset($_SESSION['house_id']))
{
	$houseID = $_SESSION['house_id'];

	$statement = "SELECT R.dName, R.roomID, RC.occupied, RC.colourID, RC.unoccupied, I.icon, I.iconID, R.roomID
					FROM room as R
					INNER JOIN room_colour as RC
					ON R.colourID = RC.colourID
					INNER JOIN icons as I
					ON R.iconID = I.iconID
					WHERE	R.houseID = $houseID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$count = $count + 1;
				
			if ($count === 1)
			{
				$roomHTML .= "<div class='row'>";
			}
				
			if(strcmp($row['dName'], "Unallocated Sensors")==0)
			{
				include_once ("{$path}../classes/SensorClass.php");
				
				$sensorHTML = "";
				
				$sensors = [];

				$sensors = Sensor::getByRoomID($row['roomID']);

				$sensorCount = 0;
	
				foreach ($sensors as $sensor)
				{
					$sensorHTML .= $sensor->getBlockFormat($sensorCount);
				}
				
				if ($sensorCount !== 0)
				{
					$sensorHTML .= "</div>";
				}	

				$roomHTML .= <<<HTML
				<div class='col-md-3'>
					<div class='panel panel-default' style="background-color: #D8D8D8;">
							<div class='row'>
								<div class='col-xs-3'>
									<i class='fa fa-warning fa-4x'></i>
								</div>
								<div class='col-xs-9 text-right'>
									<div class='huge' name=''>Unallocated Sensors</div>
								</div>
							</div>
						
					<div class='panel-body'>
						{$sensorHTML}
					</div>
				</div>
			</div>
		
HTML;
			}
		else
		{ 
	
			$occupied = Room::occupiedState($row['roomID']);
				
			$state = $occupied[0];
			$colorOCC = $occupied[1];
				
			$color = $row[$colorOCC];
			
			include_once ("{$path}../classes/SensorClass.php");
			
			$sensorHTML = "";
			
			$sensors = [];

			$sensors = Sensor::getByRoomID($row['roomID']);

			$sensorCount = 0;
	
			foreach ($sensors as $sensor)
			{
				$sensorHTML .= $sensor->getBlockFormat($sensorCount);
			}
			
			if ($sensorCount !== 0)
			{
				$sensorHTML .= "</div>";
			}
			
			$userID= $_SESSION['user_id'];
			
			$showStatement = "SELECT showRoom 
				FROM user_room
				WHERE userID = '$userID'
				AND roomID = '$row[roomID]'";
				
				$showResult = $conn->query($showStatement);
				
				if ($showResult->num_rows > 0)
				{
					$lastSeenRow = $showResult->fetch_assoc();
					
					$show = $lastSeenRow['showRoom'];
				}
				else
				{
					$show = "0";
				}

						

			$roomHTML .= <<<HTML
			<div class='col-md-3'>
				<div class='panel panel-{$color}'>
					<div class='panel-heading' onClick="openRoomForm('{$row['roomID']}', '{$row['dName']}', '{$row['colourID']}', '{$row['iconID']}', '{$show}')" style="cursor:pointer">
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
if ($count === 4)
				{
					$roomHTML .= "</div>";
					$count = 0;
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
}
else
{
	echo "house id not set";
}
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
