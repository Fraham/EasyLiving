<?php

if (isset($_GET["propertyID"]))
{
	include "../src/includes/functions.php";
	sec_session_start();
	
	$propertyID = $_GET["propertyID"];

	$option = $_GET["option"];

	if(strcmp($option, 'room') == 0)
	{
		echo getRooms(1, $propertyID);
	}
	if(strcmp($option, 'sensor') == 0)
	{
		echo getSensors(1, 1, $propertyID);
	}      
}

if (isset($_GET["roomID"]))
{
	include "../src/includes/functions.php";
	sec_session_start();
	
	$roomID = $_GET["roomID"];
	
	echo getSensors(1, 2, $roomID);
}



function getProperties($return = 0)
{
	$propertyList = "<option selected hidden value = Any>Property:</option>
	<option value = Any>Any</option>";

	require "../src/connect.php";

	$userID = $_SESSION['user_id'];

	$statement = "SELECT houseName, houseID FROM user_households WHERE user_households.userID =  $userID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$propertyList .= "<option value = ";
			$propertyList .= "$row[houseID]";
			$propertyList .= ">";
			$propertyList .= "$row[houseName]";
			$propertyList .= "</option>";
		}
	}

	$conn->close();

	if($return == 1)
		return $propertyList;
	else
		echo $propertyList;
}

function getRooms($return = 0, $propertyID = null)
{
	$roomList = "<option selected hidden value = Any>Room:</option>
	<option value = Any>Any</option>";

	require "../src/connect.php";

	$userID = $_SESSION['user_id'];

	$where = " WHERE user_households.userID = ";
	$where .= $userID;

	if(isset($propertyID))
	{
		if ($propertyID !== "Any")
		{
			$where .= " AND room.houseID = ";
			$where .= $propertyID;
		}
	}

	$statement = "SELECT dName, roomID FROM room
	INNER JOIN user_households
	ON user_households.houseID = room.houseID";
	$statement .= $where;

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$roomList .= "<option value = ";
			$roomList .= "$row[roomID]";
			$roomList .= ">";
			$roomList .= "$row[dName]";
			$roomList .= "</option>";
		}
	}

	$conn->close();

	if($return == 1)
		return $roomList;
	else
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
			$name = $row["dName"];
			$roomList .= '
			<div id="room" class=" col-lg-12 drag-handle" style="margin-bottom:10px" data-toggle="collapse" data-target="#demo">&#9776;  '.$name.'
				<div id="demo" class="collapse">
					Room Name: <input type="text" placeholder="'.$name.'" class="form-control"  />
					Colour:
					<select class="form-control">
						<option>Red</option>
						<option>Yellow</option>
						<option>Blue</option>
						<option>Green</option>
					</select>
					Icon:
					<select class="form-control">
						'.getIcons().'
					</select>
					<button class="btn btn-danger btn-block" data-toggle="collapse" data-target="#demo" style="margin-top:10px;">Confirm</button>
				</div>
			</div>';
		}
	}
	$conn->close();

	echo $roomList;
}


function getSensors($return = 0, $option = 0, $propertyID)
{
	$sensorList = "<option selected hidden value = Any>Sensor:</option>
	<option value = Any>Any</option>";  

	require "../src/connect.php";

	$userID = $_SESSION['user_id'];

	$where = " WHERE user_households.userID = ";
	$where .= $userID;

	if(isset($propertyID))
	{
		if ($propertyID !== "Any")
		{
			if ($option === 1)
			{
				$where .= " AND room.houseID = ";
			}
			else if ($option === 2)
			{
				$where .= " AND sensors.roomID = ";
			}

			$where .= $propertyID;
		}
	}

	$statement = "SELECT sensors.name, sensorID FROM sensors
	INNER JOIN room
	ON room.roomID = sensors.roomID
	INNER JOIN user_households
	ON user_households.houseID = room.houseID";  
	$statement .= $where;

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$sensorList .= "<option value = ";
			$sensorList .= "$row[sensorID]";
			$sensorList .= ">";
			$sensorList .= "$row[name]";
			$sensorList .= "</option>";
		}
	}

	$conn->close();

	if($return == 1)
		return $sensorList;
	else
		echo $sensorList;
}
function getSensorBtns($room)
{
	$sensorList = "";
	require "../src/connect.php";

	$userID = $_SESSION['user_id'];

	$statement = "SELECT sensors.name, sensors.messageOn, sensors.messageOff, sensors.sensorID, room.dName FROM sensors
	INNER JOIN room
	ON room.roomID = sensors.roomID
	INNER JOIN user_households
	ON user_households.houseID = room.houseID
	WHERE user_households.userID = $userID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		$count = 0;
		while($row = $result->fetch_assoc())
		{
			if($room == $row["dName"]){       

				$sensorList .= <<<HTML
				<div class="col-lg-6">
					<a href="" class="btn btn-default btn-block" style="margin: 5px;" data-toggle="modal" data-target="#EditModal{$count}">{$row["name"]}</a>
				</div>

				<div class="modal fade" id="EditModal{$count}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title" id="myModalLabel">Edit Sensor: {$row["dName"]} - {$row["name"]}</h2>
								<br>
								<button name="delete" class="btn btn-lg btn-danger btn-block" onclick="deleteSensor('{$row["sensorID"]}')"> Delete </button>
							</div>
							<div class="modal-body row">
								<div class="form-group col-lg-12">
									<form action="" method="post" name="login_form">
										<label>Sensor Name:</label> 
										<input type="text" placeholder="{$row["name"]}"  class="form-control"/>
										<br>  
                    <label>Message when activated:</label> 
                    <input type="text" placeholder="{$row["messageOn"]}" class="form-control"/>
                    <br>  
                    <label>Message when deactivated:</label> 
                    <input type="text" placeholder="{$row["messageOff"]}"  class="form-control"/>
                    <br>  
										<label>Room</label>
										<select class="form-control"><?php getRooms(0); ?></select>
										<br>
										<input type="button" value="Confirm" class="btn btn-lg btn-danger btn-block" onclick="formhash(this.form, this.form.password);" />
										<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
HTML;
			}
			$count++;
		}
	}

	$conn->close();

	return $sensorList;
}

function getSensorTypes($return)
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

	if($return == 1)
		return $sensorList;
	else
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

			$conn->close();
			echo $roomHTML;
	}
		else
		{
			echo "house id not set";
		}
}

	function getIcons()
	{
		$propertyList = "";

		require "../src/connect.php";

		$userID = $_SESSION['user_id'];

		$statement = "SELECT icon FROM icons";

		$result = $conn->query($statement);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$propertyList .= "<option value>";
				$propertyList .= "$row[icon]";
				$propertyList .= "</option>";
			}
		}
		return $propertyList;
	}
	
	
	function getRoomColours()
	{
		$propertyList = "";

		require "../src/connect.php";

		$userID = $_SESSION['user_id'];

		$statement = "SELECT unoccupied, colourID FROM room_colour";

		$result = $conn->query($statement);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$propertyList .= "<option value=";
				$propertyList .= "$row[colourID]";
				$propertyList .= ">";
				$propertyList .= "$row[unoccupied]";
				$propertyList .= "</option>";
			}
		}
		return $propertyList;
	}
	?>