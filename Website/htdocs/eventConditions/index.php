<?php 
	$title = "Alert Conditions";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

	<?php 
		if (empty($_POST)===false)
		{
		
			$conditionName = $_POST['conditionName'];
			require "../src/connect.php";

			$user_ID = $_SESSION['user_id'];
			$statement = "INSERT INTO event(name, userID) VALUES ('$conditionName', '$user_ID')";
			if (!$conn->query($statement)) {
				echo "Error: " . $statement . "<br>" . $conn->error;
			}
			$conn->close();
		}else{
	?>

	<div class="row">
		<?php
			require ("$path../classes/EventClass.php");
			

			$userID = $_SESSION['user_id'];

			$events = [];

			$events = Event::getByUserID($userID);

			foreach ($events as $event)
			{
				$event->getEventFormat();
			}
		?>
	<button class = "btn btn-danger btn-lg" style="margin-top:30px" data-toggle="modal" data-target="#AddConditionModal">Create New Alert</button>
	</div>

	<div class="modal fade" id="AddConditionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">Create Alert</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form action="" method="post" id="addConditionForm">
							<label>Alert Name</label> <input type="text" id="Name" name="conditionName" class="form-control"/>
							<br>
							<input type="button" value="Create Alert" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="cEvent()" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<div class="modal fade" id="AddSensorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">Add Sensor for Alert</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form class="form-horizontal" action="" method="post" id="addSensorForm" name="addSensorForm">										
							<div class="form-group">
								<label for="sensor" class="col-sm-3 control-label">Sensor</label>
								<div class="col-sm-9">
									<select class="form-control" name="sensor">
									<?php 
										include "../notifications/getNotificationsGraph.php";
										$propertyID = $_SESSION['house_ID'];
										getSensors(0,0,$propertyID);
									?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="condition" class="col-sm-3 control-label">Condition</label>
								<div class="col-sm-9">
									<select class="form-control" name="condition">
										<option value=On>On</option>
										<option value=Off>Off</option>	
									</select>
								</div>
							</div>
							<input type="hidden" id="eventID" name="eventID" value="">
							<input type="button" value="Add Sensor and Condition" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="reset" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
    	}
	?>

	<?php include $path."footer.php";?>

<script>
	function cEvent()
	{
		$.post('addCondition.php', $('#addConditionForm').serialize())
			.done(function( data ) {
				location.reload();
			});
	}
	
	function submitAddSensorForm()
	{
		$.post('addSensor.php', $('#addSensorForm').serialize())
			.done(function( data ) {
				console.log(data)
				//location.reload();
		});
	}
	
	function changeID(eventID)
	{
		$("#eventID").val = eventID;
		
		$('#AddSensorModal').modal('show');
	}
	
</script>

<?php else : ?>
<?php endif; ?>
