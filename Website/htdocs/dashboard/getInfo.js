function getOverview()
{
	$.ajax(
	{
		url: 'getOverview.php',
		dataType: 'json',
		async:true,
		success: function(result)
		{
			var overviewHTML = "";
			
			var propertyData = result['data'];				
					
			for(var j = 0; j < propertyData.length; j++) 
	      	{
				overviewHTML += "<h4>" + propertyData[j]["propertyName"] + " " + "Occupied: <span>" + propertyData[j]["occupied"] + "</span></h4>";
				  
				var sensorData = propertyData[j]["sensorData"];				
					
				for(var i = 0; i < sensorData.length; i++) 
	      		{
					overviewHTML += "<div style='text-indent: 2em;'><h4>"+ sensorData[i]["sensor"] + " (" + sensorData[i]["room"] + ") " + "<span class='text-danger'>Open</span></h4></div>"; 
				}
			}
			
			$("#overviewPanel").html(overviewHTML);
		},
		error: function(e){
			//console.log(e);
		},
		complete: function()
		{
			
		}
	});
}