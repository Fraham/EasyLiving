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
    	//var intervalID = setInterval(refresh, 500);
		refresh();
	});

	function refresh()
	{
		$.ajax({
			url: 'getNotificationPanel.php',
			//type: 'post',
			dataType: 'json',
			data: {
				'date':newDate
			},
			timeout: 30000,
			cache: false,
			success: function(result)
			{
				//var data = $.parseJSON(result);
				var data = result;
				
				if (data['newData'] === "yes")
				{
					var html = "";
					
					var htmlData = data['data'];				
					
					for(var j = 0; j < htmlData.length; j++) 
	      			{	  
						html += "<a href='notifications' class='list-group-item'>";
						html += htmlData[j]['name'] + " - " + htmlData[j]['message'];
						html += "<span class='pull-right text-muted small'><em>";
						html += htmlData[j]['time'];
						html += "</em></span>";
					}
					
					$("#notificationPanel").html(html);
					
					date = new Date($.now());
					newDate = ISODateString(date);
				}
			},
			error: function(e){
				console.log(e);
			},
			complete: function(){

				
				refresh();
			}
		});
		/*
		$.getJSON('getNotificationPanel.php', {'date':newDate}, function(data){			
			if (data['newData'] === "yes")
			{
				var html = "";
				
				var htmlData = data['data'];				
				
				for(var j = 0; j < htmlData.length; j++) 
      			{	  
					html += "<a href='notifications' class='list-group-item'>";
					html += htmlData[j]['name'] + " - " + htmlData[j]['message'];
					html += "<span class='pull-right text-muted small'><em>";
					html += htmlData[j]['date'];
					html += "</em></span>";
				}
				
				$("#notificationPanel").html(html);
				
				date = new Date($.now());
				newDate = ISODateString(date);
			}
		});*/
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

<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12" id="roomsPanel">
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
		</div>
		<div class="row">
			<div class="col-sm-12" id="roomsPanel" style="text-align:center;">
				<?php
					include "getDashboardRooms.php";
				?>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12" id="notifyPanel">
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
