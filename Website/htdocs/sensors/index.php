<?php
  $title = "Sensors";
  $path = "../src/templates/";
  include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

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
	<div class="row">
		<?php
			include("../notifications/getNotificationsGraph.php");
			getRoomsAsPanels();
		?>
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
							<label>Sensor ID:</label> <input type="number" maxlength="6" name="id" required autofocus class="form-control"/>
							<br>
							<label>Sensor Name:</label> <input type="text" id="Name" name="name" class="form-control"/>
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
									<input type="text" id="sensorID" name="sensorID" class="form-control" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input type="text" id="name" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="messageOn" class="col-sm-3 control-label">Message On</label>
								<div class="col-sm-9">
									<input type="text" id="messageOn" name="messageOn" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="messageOff" class="col-sm-3 control-label">Message Off</label>
								<div class="col-sm-9">
									<input type="text" id="messageOff" name="messageOff" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="room" class="col-sm-3 control-label">Room</label>
								<div class="col-sm-9">
									<select id="room" name="room" class="form-control">
										<?php 
											require "../src/classes/RoomCLass.php";
											
											$propertyID = $_SESSION['house_id'];
											
											Room::getRoomsDrop($propertyID);
										?>
									</select>
								</div>
							</div>							
							<input type="button" value="Edit Sensor" class="btn btn-lg btn-danger btn-block" onclick="editSensor()" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function deleteSensor()
		{
      var ID= document.getElementbyID("sensorID").value;
      alert(ID);
			$.post("deleteSensor.php", { func: "delete", id: ID })
			.done(function( data ) {
				location.reload();
			});
		};
		function submitForm()
		{
			$.post('index.php', $('#addSensorForm').serialize())
			.done(function( data ) {
				location.reload();
			});
		};
		function editSensor()
		{
			$.post('editSensor.php', $('#editSensorForm').serialize())
			.done(function( data ) {
				//console.log(data);
				location.reload();
			});
		};
		
		function openForm(sensorID, name, messageOn, messageOff, roomID)
		{
			document.forms["editSensorForm"]["sensorID"].value = sensorID;
			document.forms["editSensorForm"]["name"].value = name;
			document.forms["editSensorForm"]["messageOn"].value = messageOn;
			document.forms["editSensorForm"]["messageOff"].value = messageOff;
			document.forms["editSensorForm"]["room"].value = roomID;
			
			$('#editSensorModal').modal('show');
		};
	</script>

	<?php
    	}
	?>

	<?php
		include $path."footer.php"
	?>
  
<?php else : ?>
<?php endif; ?>