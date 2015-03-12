<?php
	$title = "Sensors";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<a><div class="panel-heading" ></a>
			Living Room
		</div>
		<div class="panel-body"id="chartBody">
		<div class="col-lg-3 col-sm-6">
			<a href="" class="btn btn-default btn-block">Sensor1</a>
		</div>
		<div class="col-lg-3 col-sm-6">
			<a href="" class="btn btn-default btn-block">Sensor2</a>
		</div>
		<div class="col-lg-3 col-sm-6">
			<a href="" class="btn btn-default btn-block">Sensor3</a>
		</div>
		<div class="col-lg-3 col-sm-6">
			<a href="" class="btn btn-default btn-block">Sensor4</a>
		</div>
		<div class="col-lg-3 col-sm-6">
			<a href="" class="btn btn-default btn-block">Sensor5</a>
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
