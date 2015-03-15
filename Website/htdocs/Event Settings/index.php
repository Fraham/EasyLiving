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
					<div class="col-lg-2">
						<select class="form-control">
							<option selected hidden>Property:</option>
							<option>Any</option>
							<?php
								include("GetPropertyChoices.php");
								getProperties();
							?>
						</select>
					</label>
				</div>
				<div class="col-lg-2">
						<select class="form-control">
							<option selected hidden>Sensor:</option>
							<option>Any</option>
							<?php
								getSensors();
							?>
						</select>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Timer for Event:</label>
					<input type="number" class="form-control" placeholder="Period of time">
				</div>
		</div>
	</div>
		
	<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>