<?php
$title = "History";
$path = "../src/templates/";
include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

	<link href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"/>
	<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

	<script src="http://code.highcharts.com/highcharts.js"></script>

	<?php
	include("getNotificationsGraph.php");
	?>

	<script type="text/javascript" src="graph.js"></script>
	<script type="text/javascript" src="history.js"></script>
	<script type="text/javascript" src="temperatureChart.js"></script>
	<!-- <script type="text/javascript" src="dropdownChange.js"></script> -->

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					History Options
				</div>
				<div class="panel-body">
					<div class="col-md-2">
						<select class="form-control" id="propertySelect">
							<option selected hidden value = Any>Property</option>
							<option value = Any>Any</option>
							<?php
							//getProperties();
							?>
						</select>
					</div>
					<div class="col-md-2">
						<select class="form-control" id="roomSelect">
							<option selected hidden value = Any>Room</option>
							<option value = Any>Any</option>
							<?php
							//getRooms();
							?>
						</select>
					</div>
					<div class="col-md-2">
						<select class="form-control" id="sensorSelect">
							<option selected hidden value = Any>Sensor</option>
							<option value = Any>Any</option>
							<?php
							//getSensors();
							?>
						</select>
					</div>

					<div class="col-md-2">
						<input type="text" class="form-control text-center" id="startDate" placeholder="Enter Start Date"></input>
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control text-center" id="endDate" placeholder="Enter End Date"></input>
					</div>

					<div class="col-md-2">
						<button type="button" class="btn btn-lg btn-danger" onclick="confirm()" >Confirm</button>
					</div>

					<div class="col-md-12">
						<div class="panel panel-default" id="propertySelectionPanel" style="display: none;">
							<div class="panel-heading">
								Property
							</div>
							<div class="panel-body" id="propertySelectionPanelBody">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="panel panel-default" id="roomSelectionPanel" style="display: none;">
							<div class="panel-heading">
								Room
							</div>
							<div class="panel-body" id="roomSelectionPanelBody">

							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="panel panel-default" id="sensorSelectionPanel" style="display: none;">
							<div class="panel-heading">
								Sensor
							</div>
							<div class="panel-body" id="sensorSelectionPanelBody">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default" id="histroyChartPanel">
				<div class="panel-heading">
					History Charts
				</div>
				<div class="panel-body"id="chartBody">
					<div class="col-md-12">

						<div id="eventsChart" style="height: 400px; margin: 0 auto">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6" id="temperaturePanelSize">
			<div class="panel panel-default">
				<div class="panel-heading">
			        Temperature Chart
			        <div class="btn-group pull-right">
						<a onClick="confirm()" class="btn btn-default btn-sm hidden-xs"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
			            <a onClick="togglePanelSize('temp')" class="btn btn-default btn-sm hidden-xs">Toggle</a>
			        </div>
			    </div>
				<div class="panel-body"id="chartBody">
					<div class="col-md-12" id="tempGraph">
						<div id="temperatureChart" style="height: 400px; margin: 0 auto">

						</div>
					</div>
					<div class="col-md-12" id="tempDetails">
						<div class="col-md-3 col-sm-4">
							<h4>
								Highest Temperature
							</h4>
							<span>
								<span id="highestTemp">
									NaN
								</span>
								&deg;C
							</span>
						</div>
						<div class="col-md-3 col-sm-4">
							<h4>
								Lowest Temperature
							</h4>
							<span>
								<span id="lowestTemp">
									NaN
								</span>
								&deg;C
							</span>
						</div>
						<div class="col-md-3 col-sm-4">
							<h4>
								Average Temperature
							</h4>
							<span>
								<span id="averageTemp">
									NaN
								</span>
								&deg;C
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6" id="humidityPanelSize">
			<div class="panel panel-default">
				<div class="panel-heading">
					Humidity Chart
					<div class="btn-group pull-right">
						<a onClick="confirm()" class="btn btn-default btn-sm hidden-xs"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
			            <a onClick="togglePanelSize('hum')" class="btn btn-default btn-sm hidden-xs">Toggle</a>
			        </div>
				</div>
				<div class="panel-body"id="chartBodyH">
					<div class="col-md-12" id="humGraph">
						<div id="humidityChart" style="height: 400px; margin: 0 auto">

						</div>
					</div>
					<div class="col-md-12" id="humDetails">
						<div class="col-md-3 col-sm-4">
							<h4>
								Highest Humidity
							</h4>
							<span>
								<span id="highestHum">
									NaN
								</span>
								%
							</span>
						</div>
						<div class="col-md-3 col-sm-4">
							<h4>
								Lowest Humidity
							</h4>
							<span>
								<span id="lowestHum">
									NaN
								</span>
								%
							</span>
						</div>
						<div class="col-md-3 col-sm-4">
							<h4>
								Average Humidity
							</h4>
							<span>
								<span id="averageHum">
									NaN
								</span>
								%
							</span>
						</div>
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

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default" id="historyTablePanel">
				<div class="panel-heading">
					Historys Tables
				</div>
				<div class="panel-body panel-collapse" id="notiBody">
					<div class="dataTable_wrapper">

						<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="notifications">
							<thead>
								<tr>
									<th>Room</th>
									<th>Sensor Name</th>
									<th>Message</th>
									<th>Date and Time</th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<th>Room</th>
									<th>Sensor Name</th>
									<th>Message</th>
									<th>Date and Time</th>
								</tr>
							</tfoot>
						</table>

						<script>
							var table;
							$(document).ready(function()
							{
								table = $('#notifications').dataTable(
									{

										'bSort':true,
										"bScrollY": "200px",
										"bScrollCollapse": true,
										"searching": true,
										"bPaginate": true,
										"aaSorting": [[ 3, "desc" ]]
									}
								);

								confirm();
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
include $path."footer.php"
?>
<?php endif; ?>
