<?php 
	$title = "Alert Conditions";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
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
	<button class = "btn btn-danger btn-lg" style="margin-top:30px">Create New Event</button>
	</div>
	<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>
