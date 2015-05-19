<?php 
	$title = "Event Conditions";
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
				<div class="panel-body"id="settingsBody">
					<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add sensor</button>
					<br>
					<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add condition</button>
					<br>
					<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add device to be activated</button>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
				Fridge Door Notification
				</div>
				<div class="panel-body"id="settingsBody">
					<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add sensor</button>
					<br>
					<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add condition</button>
					<br>
					<button class = "btn btn-danger btn-lg" style="margin-top:30px">Add device to be activated </button>
				</div>
			</div>
		</div>
	<button class = "btn btn-danger btn-lg" style="margin-top:30px">Create New Event</button>
	</div>
	<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>
