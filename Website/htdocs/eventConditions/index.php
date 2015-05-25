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
							<label>Alert Name</label> <input type="text" name="conditionName" autofocus class="form-control"/>
							<br>
							<button class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="createEvent()">Create Alert</button>
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
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
	function createEvent()
	{
		alert("hello");
		$.post('addCondition.php', $('#addConditionForm').serialize())
			.done(function( data ) {
				location.reload();
			});
	}
</script>

<?php else : ?>
<?php endif; ?>
