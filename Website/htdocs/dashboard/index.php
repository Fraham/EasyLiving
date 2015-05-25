<?php
	 $title = "Dashboard";
	 $path = "../src/templates/";
	 include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<script>
	refresh();
	function refresh()
	{
		$.post( "getNotificationPanel.php", function( data ) {
			$( "#notificationPanel" ).html( data );
		});
	}
	var intervalID = setInterval(refresh, 500);
</script>

<div class="col-lg-8 col-md-8 roomsPanel">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-home fa-fw"></i> Overview
			</div>
			<div class="panel-body">
				<?php
					include "getDoors.php";
				?>
			</div>
		</div>

	</div>
</div>
<div class=" col-lg-4 col-md-4 notifyPanel">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bell fa-fw"></i> Notifications Panel
		</div>
		<div class="panel-body">
			<div class="list-group" id="notificationPanel"></div>
			<a href="/notifications" class="btn btn-default btn-block">View All Alerts</a>
		</div>
	</div>
</div>
<div class="col-lg-8 col-md-8 roomsPanel">
	<div class="col-lg-12" style="text-align:center;">
		<?php
			include "getDashboardRooms.php";
		?>
	</div>
</div>

<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
