<?php
	 $title = "Dashboard";
	 $path = "../src/templates/";
	 include $path."main.php";
?>
	
	
<div class="col-lg-9"> 
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-home fa-fw"></i> House Overview
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<h4>Front Door: <span class="text-success">Closed</span></h4>
				<h4>Back Door: <span class="text-success">Closed</span></h4>
				<h4>House Occupied: <span class="text-warning">Yes</span></h4>

			</div>
			<!-- /.panel-body -->
		</div>

	</div>
	<!-- /#page-wrapper -->
	<div class="col-lg-12" id = "roomsPanel">
		<script>
			refresh();
			function refresh()
			{
				$.post( "../src/func/getRooms.php", function( data ) {
					$( "#roomsPanel" ).html( data );
				});
			}
			var intervalID = setInterval(refresh, 500);
		</script>

		<div class="clearfix visible-md-block visible-lg-block"></div>


		<div class="clearfix visible-md-block"></div>

	</div>
</div>
<div class="col-lg-3 col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bell fa-fw"></i> Notifications Panel
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="list-group" id="notificationPanel">
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
			</div>
			<!-- /.list-group -->
			<a href="/notifications" class="btn btn-default btn-block">View All Alerts</a>
		</div>
		<!-- /.panel-body -->
	</div>

</div>
<script>	
	$('.btn-toggle').click(function() {
		$(this).find('.btn').toggleClass('active');  

		if ($(this).find('.btn-danger').size()>0) {
			$(this).find('.btn').toggleClass('btn-danger');
		}
		$(this).find('.btn').toggleClass('btn-default');
	});

	$('form').submit(function(){
		alert($(this["options"]).val());
		return false;
	});
</script>

<?php include $path."footer.php"; ?>