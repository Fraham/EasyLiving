<?php 
	$title = "Event Settings";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
				Fridge Door Buzzer
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
				Fridge Door Notification
				</div>
				<div class="panel-body"id="settingsBody">
					<div class="col-lg-6">
					<label>Number of Sensors</label>
					<input type="number" id="noOfSensors" min="0" class="form-control" placeholder="Choose number of sensors">
					</div>
					<div class="col-lg-6">
						<button class = "btn btn-danger" style="margin-top:24px">Submit</button>
					</div>

					<div class="col-lg-12" style="margin-top:10px">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<label>Sensor Location</label>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<label>Sensor</label>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<label>Timer:</label>
						</div>
					<?php 
						$loopvalue = 3;
	
						for ($i = 1; $i <= $loopvalue; $i++) {
						echo '
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
										<select class="form-control">
											<option selected hidden>Any</option>
												<option>Any</option>
											<?php
												getRooms();
											?>
										</select>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
										<select class="form-control">
											<option selected hidden>---</option>
											<?php
												getSensors();
											?>
										</select>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
										<input type="number" min="0" class="form-control" placeholder="Period of time">
									</div>';
						}
					?>
		</div>
	</div>
	</div>
	<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add Notification Type</button>
		
	<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>
