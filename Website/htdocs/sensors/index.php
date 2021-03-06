<?php
  $title = "Sensors";
  $pageName = "sensors";
  $path = "../src/templates/";
  include $path."main.php";
  //sec_session_start();
	//session_start();
?>

<?php if (login_check($conn) == true) : ?>
	<script src="sensors.js"></script>
	<?php
		If (empty($_POST)===false)
		{
			$sensorID = $_POST['id'];
			$sensorName = $_POST['name'];
			$messageOn = $_POST['messageOn'];
			$messageOff = $_POST['messageOff'];
			$room = $_POST['room'];
			require "../src/connect.php";

			$userID = $_SESSION['user_id'];
			$statement = "INSERT INTO sensors VALUES('$sensorID', '$sensorName', '$messageOn', '$messageOff','$room','0')";
			if (!$conn->query($statement)) {
				echo "Error: " . $statement . "<br>" . $conn->error;
			}
			$conn->close();
		}else{
	?>
			<?php
			include("../notifications/getNotificationsGraph.php");
		?>
	<div class="row">
		<div id="sensorsPanel">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<button class="btn btn-danger center-block btn-lg" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i></button>
		</div>
	</div>

	<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">Add Sensor</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form action="" method="post" id="addSensorForm">
							<label>Sensor ID:</label> <input type="text" id="id" name="id" maxlength="6" autofocus class="form-control"/>
							<br>
							<label>Sensor Name:</label> <input type="text" id="Name" name="name" class="form-control"/>
							<br>
								<p> (Please do not use an apostrophe) </p>
							<br>
							<label>Message when activated</label> <input type="text" name="messageOn" class="form-control"/>
							<br>
							<label>Message when deactivated</label> <input type="text" name="messageOff" class="form-control"/>
							<br>
							<label>Room</label>
							<select class="form-control" required name="room">
								<?php getRooms(0); ?>
							</select>
							<br>
							<input type="button" value="Add Sensor" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editSensorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

					<h2 class="modal-title" id="myModalLabel">Edit Sensor</h2>
					<button name="delete" class="btn btn-lg btn-danger btn-block" onclick="deleteSensor()"> Delete </button>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form class="form-horizontal" action="" method="post" id="editSensorForm" name="editSensorForm">
							<div class="form-group">
								<label for="sensorID" class="col-sm-3 control-label">Sensor ID</label>
								<div class="col-sm-9">
									<input type="text" id="sensorIDEdit" name="sensorID" class="form-control" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input type="text" id="nameEdit" name="name" class="form-control"/>
									<br>
									<p> (Please do not use an apostrophe) </p>
								</div>
							</div>
							<div class="form-group">
								<label for="messageOn" class="col-sm-3 control-label">Message On</label>
								<div class="col-sm-9">
									<input type="text" id="messageOnEdit" name="messageOn" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="messageOff" class="col-sm-3 control-label">Message Off</label>
								<div class="col-sm-9">
									<input type="text" id="messageOffEdit" name="messageOff" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="room" class="col-sm-3 control-label">Room</label>
								<div class="col-sm-9">
									<select id="roomEdit" name="room" class="form-control">
										<?php
											require "../src/classes/RoomClass.php";

											$propertyID = $_SESSION['house_id'];

											Room::getRoomsDrop($propertyID);
										?>
									</select>
								</div>
							</div>
							<input type="button" value="Confirm" class="btn btn-lg btn-danger btn-block" onclick="editSensor()" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="VerifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title" id="myModalLabel">Verify Sensor</h2>
					<h3>Please press the button on the sensor to verify it to the Property</h3>
					<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
				</div>
			</div>
		</div>
	</div>

	<?php
    	}
	?>

	<?php
		include $path."footer.php"
	?>

<?php else : ?>
<?php endif; ?>