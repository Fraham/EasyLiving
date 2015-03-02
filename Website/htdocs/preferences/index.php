<?php
$title = "Preferences";
$path = "../src/templates/";
include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

	<div class="row">
		<div class="col-lg-12">

			<div class="panel panel-default">
				<a><div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#houseBody"></a>
					Household Preferences
				</div>
				<div class="panel-body panel-collapse collapse"id="houseBody">

				</div>
			</div>
			<div class="panel panel-default">
				<a><div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#userBody"></a>
					User Preferences
				</div>
				<div class="panel-body panel-collapse collapse in"id="userBody">
					<div class="col-lg-6">
						<label>In General, I would like to recieve:</label>
						<select class="form-control">
							<option>Push Notifications</option>
							<option>Email Notifications</option>
							<option>Email and Push Notifications</option>
						</select>
					</div>
				</div>
			</div>



		</div>
	</div>
	<?php
	include $path."footer.php";
	?>

<?php else : ?>
<?php endif; ?>
