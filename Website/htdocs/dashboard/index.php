<?php
	 $title = "Dashboard";
	 $path = "../src/templates/";
	 include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<script>
	var date = new Date("July 21, 1983 01:15:00");
	var newDate = ISODateString(date);
	
	$( document ).ready(function() {
    	var intervalID = setInterval(refresh, 500);
	});

	function refresh()
	{
			/*$.post( "getNotificationPanel.php", function( data ) {
				$( "#notificationPanel" ).html( data );
			});*/
			
		$.getJSON("getNotificationPanel.php?date=" + newDate, function (data)
		{
			console.log(data);
			var newData = "newData";
			console.log(data[newData]);
			if (data[newData] === "yes")
			{
				var setData = "data";
				$( "#notificationPanel" ).html( data[setData] );
				
				date = new Date($.now());
				newDate = ISODateString(date);
			}
		});
	}
	
	function ISODateString(d)
	{
		
  		function pad(n)
		{
			  return n<10 ? '0'+n : n
		}
		
	 	 return d.getUTCFullYear()+'-'
	      + pad(d.getUTCMonth()+1)+'-'
	      + pad(d.getUTCDate()) +' '
	      + pad(d.getUTCHours() + 1)+':'
	      + pad(d.getUTCMinutes())+':'
	      + pad(d.getUTCSeconds())
	}


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

<script>
		function turnOn(sensorID)
		{			
			$.post("turnOn.php", { sensorID: sensorID })
			.done(function( data ) {
				location.reload();
			});
		};
		function turnOff(sensorID)
		{			
			$.post("turnOff.php", { sensorID: sensorID })
			.done(function( data ) {
				location.reload();
			});
		};
		
</script>

<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
