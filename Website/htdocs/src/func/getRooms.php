<?php
require_once "../src/connect.php";
$roomHTML = "";

if (!isset($blockSize))
	$blockSize = 370;

if (isset($_SESSION['house_id']))
{

	$houseID = $_SESSION['house_id'];

	$statement = "SELECT R.dName, R.roomID, RC.occupied, RC.unoccupied, I.icon, R.roomID
									FROM room as R
									INNER JOIN room_colour as RC
									ON R.colourID = RC.colourID
									INNER JOIN icons as I
									ON R.iconID = I.iconID
									WHERE	R.houseID = $houseID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		$count = 0;
		while($row = $result->fetch_assoc())
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
				$state = "Unoccupied";
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
					<a data-toggle="modal" data-target="#EditRoomModal{$count}">	
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
					</a>
				</div>
				<div class='panel-body'>
					{$sensorHTML}
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditRoomModal{$count}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title" id="myModalLabel">Edit Room: {$row["dName"]}</h2>
								<br>
								<button name="delete" class="btn btn-lg btn-danger btn-block" onclick="deleteRoom('{$row["roomID"]}')"> Delete </button>
							</div>
							<div class="modal-body row">
								<div class="form-group col-lg-12">
									<form action="" method="post" name="login_form">
										<label>Room Name:</label> <input type="text" id="Name" placeholder="{$row["dName"]}" name="name" class="form-control"/>
										<br>
										<label>Colour</label>
										<select class="form-control" name="colour">
											<?php
											getRoomColours(); ?>
										</select>
										<br>
										<label>Icon</label>
										<select class="form-control" name="icon">
											<?php getIcons(); ?>
										</select>
										<br>
										<input type="button" value="Save Changes" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
										<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
HTML;
		$count++;
		}
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
