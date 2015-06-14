<?php
$title = "History";
$path = "../src/templates/";
include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

	<link href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"/>
	<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

	<?php
	include("getNotificationsGraph.php");
	?>

	<script type="text/javascript" src="graph.js"></script>
	<script type="text/javascript" src="dropdownChange.js"></script>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Notification Options
				</div>
				<div class="panel-body">
					<div class="col-md-2">
						<select class="form-control" id="propertySelect">
							<?php
							getProperties();
							?>
						</select>
					</label>
				</div>
				<div class="col-md-2">
					<select class="form-control" id="roomSelect">
						<?php
						getRooms();
						?>
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control" id="sensorSelect">
						<?php
						getSensors();
						?>
					</select>
				</label>
			</div>

			<div class="col-md-2">
				<input type="text" class="form-control text-center" id="startDate" placeholder="Enter Start Date"></input>
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control text-center" id="endDate" placeholder="Enter End Date"></input>
			</div>

			<div class="col-md-2">
				<button type="button" class="btn btn-lg btn-danger" onclick="confirm()" >Confirm</button>

				<script>
					
				//confirm();				

				function confirm()
				{
					var url = "";

					var houseID = $('#propertySelect').val();

					var roomID = $('#roomSelect').val();

					var sensorID = $('#sensorSelect').val();

					try
					{
						var start =	$("#startDate").datepicker( 'getDate' );

						//start.setDate( start.getDate() + 1 );

						var startDate = start.toISOString().slice(0, 11).replace(' ', '').replace('T', '');

						startDate = startDate + " 00:00:00";
					}
					catch(err)
					{
						startDate = "1970-02-01 00:00:00"
					}

					try
					{
						var end = $("#endDate").datepicker( 'getDate' );

						//end.setDate( end.getDate() + 1 );

						var endDate = end.toISOString().slice(0, 11).replace(' ', '').replace('T', '');

						endDate = endDate + " 23:59:59";
					}
					catch(err)
					{
						endDate = "2020-02-01 00:00:00"
					}

					url = "?propertyID=" + houseID + "&roomID=" + roomID + "&sensorID=" + sensorID + "&startDate=" + startDate + "&endDate=" + endDate;
						
					/*$.post("getNotificationTable.php" + url, function( data ) {
						$("#notifications").html( data );
					});*/
					
					table.fnClearTable();
					
					$.getJSON("getTableJSON.php" + url, function (data)
					{
						//var jsdata = JSON.parse(data);
						$('#notifications').dataTable().fnAddData(data);
					});

					changeGraph(url);
				}
				</script>
			</div>
		</div>
	</div>
</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Notification Charts
			</div>
			<div class="panel-body"id="chartBody">
				<div class="col-md-12">
					<script src="http://code.highcharts.com/highcharts.js"></script>
					<div id="events" style="height: 400px; margin: 0 auto">

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
		<div class="panel panel-default">
			<div class="panel-heading">
				Notifications Tables
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
								/*'aoColumns': [
									{ bSearchable: true, bSortable: true },
									{ bSearchable: true, bSortable: true },
									{ bSearchable: true, bSortable: true },
									{ bSearchable: true, bSortable: true }
								],*/
								"bScrollY": "200px",
								"bScrollCollapse": true,
								"searching": true,
								"bPaginate": true,
								"aaSorting": [[ 3, "desc" ]]
							}
						);
						
						confirm();
					});
						/*$('#notifications').dataTable({
							'bSort':true,
							'aoColumns': [
								{  bSearchable: false, bSortable: true },
								{ bSearchable: false, bSortable: false },
								{ bSearchable: false, bSortable: false },
								{ bSearchable: false, bSortable: false }
							],
							"bScrollY": "200px",
							"bScrollCollapse": true,
							"searching": false,
							"bPaginate": true
						});*/
						
					
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
