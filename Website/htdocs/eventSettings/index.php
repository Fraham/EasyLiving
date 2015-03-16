<?php 
	$title = "Event Settings";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
				Fridge Door Buzzer
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
				Fridge Door Notification
				</div>
				<div class="panel-body"id="settingsBody">
					<label>Number of Sensors</label>
					<input type="number" id="noOfSensors" class="form-control" placeholder="Choose number of sensors">
					<div class="row">
						<div class="col-lg-2">
							<label>Sensor Location</label>
						<div class="col-lg-2">
							<label>Sensor</label>
						<div class="col-lg-2">
							<label>Timer:</label>
					<?php 
						$loopvalue = 3;
	
						for ($i = 1; $i <= $loopvalue; $i++) {
						echo '<div class="row">
								<div class="col-lg-4">
								<select class="form-control">
									<option selected hidden>Any</option>
										<option>Any</option>
									<?php
										getRooms();
									?>
								</select>
							</label>
						</div>';
						echo '<div class="col-lg-4">
								<select class="form-control">
									<option selected hidden>---</option>
									<?php
										getSensors();
									?>
								</select>
							</label>
						</div>';
						echo '<div class="col-lg-4">
									<input type="number" class="form-control" placeholder="Period of time">
								</div>
						</div>';
						}
					?>
		</div>
	</div>
		
	<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>
