<?php
	$title = "Notifications";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<a><div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#chartBody"></a>
			Notification charts
		</div>
		<div class="panel-body panel-collapse collapse"id="chartBody">

			<div class="col-lg-3 col-md-3">
				<select class="form-control">
					<option selected hidden>Room:</option>
					<?php include "getNotificationsGraphRooms.php"; ?>
				</select>
			</label>
		</div>
		<div class="col-lg-3 col-md-3">
			<select class="form-control">
				<option selected hidden>Sensor:</option>
				<?php include "getNotificationsGraphSensor.php"; ?>
			</select>
		</label>
	</div>

	<div class="col-lg-3 col-md-3">
		<input  class="btn btn-default btn-block" readonly placeholder="Start Date"  id="startDate">
	</div>
	<div class="col-lg-3 col-md-3">
		<input  class="btn btn-default btn-block" readonly placeholder="End Date"  id="endDate">
	</div>

</div>
<div>


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
	<a><div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#notiBody"></a>
	Notifications Tables
</div>
<!-- /.panel-heading -->
<div class="panel-body panel-collapse collapse" id="notiBody">
	<div class="dataTable_wrapper">
		<table class="table table-striped table-bordered table-hover" id="notifications">

			<script>
				refresh();

				function refresh()
				{
					$.post("getNotificationTable.php", function( data ) {
						$("#notifications").html( data );
					});
				}
				var intervalID = setInterval(refresh, 500);
			</script>
		</div>
	</div>

	<?php
	include $path."footer.php"
	?>

<?php else : ?>
<?php endif; ?>
