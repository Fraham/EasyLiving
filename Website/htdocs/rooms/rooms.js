getRooms();

function getRooms() {
	$("#roomsPanel").empty();
	$.ajax(
		{
			url: 'getRooms.php',
			dataType: 'json',
			async: true,
			success: function (result) 
			{
				var roomHTML = "";

				var roomData = result['data'];

				for (var j = 0; j < roomData.length; j++) 
				{
					roomHTML = "";
					roomHTML += "<div class='col-md-3'> \
				<div class='panel panel-" + (roomData[j]["occupied"] === 0 ? roomData[j]["colourUnoccupied"] : roomData[j]["colourOccupied"]) + "'> \
					<div class='panel-heading' onClick='openRoomForm('{$row['roomID']}', '{$row['dName']}', '{$row['colourID']}', '{$row['iconID']}', '{$show}')' style='cursor:pointer'> \
						<div class='row'> \
							<div class='col-xs-3'> \
								<i class='fa fa-" + roomData[j]["icon"] + " fa-4x'></i> \
							</div> \
							<div class='col-xs-9 text-right'> \
								<div class='huge' name=''>" + roomData[j]["name"] + "</div> \
								<div>{$state}</div> \
							</div> \
						</div> \
					</div> \
				<div class='panel-body'> \
				" +	roomData[j]["sensorData"] + " \
				</div> \
			</div> \
		</div>"; 
					
					var sensorData = roomData[j]["sensorData"];	
					
					roomHTML += sensorData;
					
					/*for(var i = 0; i < sensorData.length; i++)  
					{
						
					}*/
					roomHTML += "</div></div></div>";
					if ((j + 1) % 4 === 0)
						roomHTML += "<div class='clearfix'>";	
									
					$(roomHTML).hide().appendTo("#roomsPanel").fadeIn("slow");
				}
			},
			error: function (e) {
				//console.log(e);
			},
			complete: function () {

			}
		});
};