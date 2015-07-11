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
					var sensorPanelID = roomData[j]["id"] + "sensorPanel";

					roomHTML = "";
					roomHTML += "<div class='col-md-3'> \
				<div class='panel panel-" + (roomData[j]["state"] === "Occupied" ? roomData[j]["colourOccupied"] : roomData[j]["colourUnoccupied"]) + "'> \
					<div class='panel-heading' onClick=" + '"' +  "openRoomForm('" + roomData[j]["id"] + "', '" + roomData[j]["name"] + "', '" + roomData[j]["colourID"] + "', '" + roomData[j]["iconID"] + "', '" + roomData[j]["show"] + "')" + '"' +  " style='cursor:pointer'> \
						<div class='row'> \
							<div class='col-xs-3'> \
								<i class='fa fa-" + roomData[j]["icon"] + " fa-2x'></i> \
							</div> \
							<div class='col-xs-9 text-right'> \
								<div class='' name=''>" + roomData[j]["name"] + "</div> \
								<div>" + roomData[j]["state"] + "</div> \
							</div> \
						</div> \
					</div> \
				<div class='panel-body' id='" + sensorPanelID + "'> \
				</div> \
			</div> \
		</div>";

					//roomHTML += "</div></div></div>";

					if ((j + 1) % 4 === 0)
						roomHTML += "<div class='clearfix'>";

					$(roomHTML).hide().appendTo("#roomsPanel").fadeIn("slow");




					var sensorData = roomData[j]["sensorData"];

					var sensorCount = 0;

					for(var i = 0; i < sensorData.length; i++)
					{
						if (sensorData[i]["count"] > 0)
						{
							var sensorHTML = sensorData[i]["sensorHTML"];
							if (sensorData[i]["count"] > 1)
							{
								sensorHTML = "<div class='clearfix'>" + sensorHTML;
							}
							if ((sensorCount = sensorCount + sensorData[i]["count"]) % 2 === 0)
							{
								sensorHTML += "<div class='clearfix'>";
							}

							$(sensorHTML).hide().appendTo("#"+sensorPanelID).fadeIn("slow");
						}
					}
				}
			},
			error: function (e) {
				//console.log(e);
			},
			complete: function () {

			}
		});
};

function reloadPage()
{
	getRooms();
}