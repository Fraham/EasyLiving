<?php
	$title = "Sensors";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-danger">
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
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-warning">
			<a><div class="panel-heading" ></a>
			Kitchen
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

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<a><div class="panel-heading" ></a>
			Bedroom
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

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success	">
			<a><div class="panel-heading" ></a>
			Office
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

	<?php
	include $path."footer.php"
	?>

<?php else : ?>
<?php endif; ?>
