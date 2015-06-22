<?php
	$roomHTML = "";
	require "../src/connect.php";
	
	require_once "../src/classes/RoomClass.php";
	require_once "../src/classes/SensorClass.php";
	
	include "../src/includes/functions.php";

	sec_session_start();

	if (isset($_SESSION['house_id']))
	{
		$houseID = $_SESSION['house_id'];
		
		$rooms = [];
		
		$rooms = Room::getRoomsByPropertyID($houseID);
		
		$jsonRooms = array();
		
		foreach($rooms as $room)
		{
			//get sensor data
			$sensorData = getSensorBtns($room->roomID);
			$jsonRooms[] = array("name" => $room->defaultName, "colour" => $room->unoccupiedColour, "sensorData" => $sensorData); 
		}

		/*$statement = "SELECT R.dName, R.roomID, RC.unoccupied
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
				$room = $row["dName"];

			$unallocated= "Unallocated Sensors";
			if(strcmp($row['dName'],$unallocated)==0)
			{
					
					$roomHTML .='
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="panel" style="background-color: #D8D8D8;">
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
				else
				{
					$color = $row["unoccupied"];

					$roomHTML .='
					<div class="col-lg-4 col-md-4 col-sm-4">
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
		}*/
		$jsonResult['message'] = "okay";
		$jsonResult['data'] = $jsonRooms;
		$conn->close();
//			echo $roomHTML;
	}
	else
	{
		$jsonResult['message'] = "house ID not set";
	}
	
	
    //$jsonResult['data'] = $propertyData;		
	
	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
	
function getSensorBtns($roomID)
{
	$sensorList = "";
	require "../src/connect.php";

	$statement = "SELECT sensors.roomID, sensors.name, sensors.messageOn, sensors.messageOff, sensors.sensorID, room.dName 
	FROM sensors
	INNER JOIN room
	ON room.roomID = sensors.roomID
	WHERE room.roomID = '$roomID'";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		$count = 0;
		while($row = $result->fetch_assoc())
		{
			$sensorList .= <<<HTML
			<div class="col-lg-6">
				<a class="btn btn-default btn-block" style="margin: 5px;" onClick="openForm('{$row['sensorID']}', '{$row['name']}', '{$row['messageOn']}', '{$row['messageOff']}', '{$row['roomID']}')">{$row["name"]}</a>
			</div>
HTML;
			$count++;
		}
	}

	$conn->close();

	return $sensorList;
}
?>