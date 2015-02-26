<?php
	 $title = "Dashboard";
	 $path = "../src/templates/";
	 include $path."main.php";
?>

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

<div class="col-lg-8 roomsPanel">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-home fa-fw"></i> House Overview
			</div>
			<div class="panel-body">
				<h4>Front Door: <span class="text-success">Closed</span></h4>
				<h4>Back Door: <span class="text-success">Closed</span></h4>
				<h4>House Occupied: <span class="text-warning">Yes</span></h4>

			</div>
		</div>

	</div>
	<div class="col-lg-12" style="text-align:center;">
		<?php
			include "../src/func/getRooms.php";
		?>

		<!-- <div class="clearfix visible-md-block visible-lg-block"></div> -->
		<!-- <div class="clearfix visible-md-block"></div> -->

	</div>
</div>
<div class="col-lg-4 col-md-12 notifyPanel">
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

<?php include $path."footer.php"; ?>
