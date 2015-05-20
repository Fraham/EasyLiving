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

	<script>
		function deleteSensor(ID)
		{
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
	</script>

	<?php
    	}
	?>

	<?php
		include $path."footer.php"
	?>
  
<?php else : ?>
<?php endif; ?>