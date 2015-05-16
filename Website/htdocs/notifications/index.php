<?php
$title = "Event History";
$path = "../src/templates/";
include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

	<?php
		include("getNotificationsGraph.php");
	?>

	<script type="text/javascript" src="graph.js"></script>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
					Notification Options
				</div>
				<div class="panel-body">
					<div class="col-lg-2">
						<select class="form-control" id="propertySelect">
							<option selected hidden value = Any>Property:</option>
							<option value = Any>Any</option>
							<?php
								getProperties();
							?>

						</select>
					</label>
				</div>
				<div class="col-lg-2">
					<select class="form-control" id="roomSelect">
						<option selected hidden>Room:</option>
						<option>Any</option>
						<?php
						getRooms();
						?>
					</select>
				</div>
				<div class="col-lg-2">
					<select class="form-control" id="sensorSelect">
						<option selected hidden>Sensor:</option>
						<option>Any</option>
						<?php
						getSensors();
						?>
					</select>
				</label>
			</div>

			<div class="col-lg-2 col-md-3">
				<input type="text" class="form-control text-center" id="startDate" placeholder="Enter Start Date"></input>
			</div>
			<div class="col-lg-2 col-md-3">
				<input type="text" class="form-control text-center" id="endDate" placeholder="Enter End Date"></input>

			</div>

			<div class="col-lg-2 col-md-3">
				<button type="button" class="btn btn-lg btn-danger" onclick="confirm()" >Confirm</button>
					
				<script>
					confirm();
					
					function confirm()
					{
						var houseID = $('#propertySelect').val();
						
						$.post("getNotificationTable.php?propertyID=" + houseID, function( data ) {
							$("#notifications").html( data );
						});
					}
				</script>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<a><div class="panel-heading" ></a>
				Notification Charts
			</div>
			<div class="panel-body"id="chartBody">


				<div class="col-lg-12 col-md-12">
				<script src="http://code.highcharts.com/highcharts.js"></script>
				<div id="events" style="height: 400px; margin: 0 auto"></div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
$('#startDate').datepicker({
	format: 'dd MM yyyy',
	autoclose: true,
});
$('#endDate').datepicker({
	format: 'dd MM yyyy',
	autoclose: true,
});
</script>

<script type="text/javascript">
$('#form_datetime1').datetimepicker({
	format: 'yyyy-mm-dd hh:ii',
	autoclose: true,
	todayBtn: true,
	minuteStep: 5
});
</script>





<div class="panel panel-default">
	<div class="panel-heading">
		Notifications Tables
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body panel-collapse" id="notiBody">
		<div class="dataTable_wrapper">
			<table class="table table-striped table-bordered table-hover" id="notifications">

			<script>
			/*refresh();

			function refresh()
			{
				$.post("getNotificationTable.php", function( data ) {
					$("#notifications").html( data );
				});
			}
			var intervalID = setInterval(refresh, 500);*/
			</script>
		</div>
	</div>

	<?php
	include $path."footer.php"
	?>
<?php endif; ?>
