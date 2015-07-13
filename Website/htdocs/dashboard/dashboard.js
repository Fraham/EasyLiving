
var date = new Date("July 21, 1983 01:15:00");
var newDate = ISODateString(date);

var refreshAjax;

getRooms();

$(document).ready(function () {
	//var refreshAjax;
	refresh();
	getOverview();
});

$(window).unload(function () {
  		refreshAjax.abort();
});

window.onunload = unloadPage;
function unloadPage() {
	refreshAjax.abort();
}

$(window).bind('beforeunload', function () {
	refreshAjax.abort();
});

function reloadPage() {
	refreshAjax.abort();
	var date = new Date("July 21, 1983 01:15:00");
	newDate = ISODateString(date);
}

function refresh() {
	refreshAjax = $.ajax({
		url: 'getNotificationPanel.php',
		dataType: 'json',
		async: true,
		data: {
			'date': newDate
		},
		timeout: 30000,
		cache: false,
		success: function (result) {
			var data = result;

			if (data['newData'] === "yes") {
				var html = "";

				var htmlData = data['data'];

				for (var j = 0; j < htmlData.length; j++) {
					html += "<a href='../notifications' class='list-group-item'>";
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
		error: function (e) {
			//console.log(e);
		},
		complete: function () {


			refresh();
		}
	});
}

function ISODateString(d) {
  	function pad(n) {
		return n < 10 ? '0' + n : n
	}

	 	 return d.getUTCFullYear() + '-'
		+ pad(d.getUTCMonth() + 1) + '-'
		+ pad(d.getUTCDate()) + ' '
		+ pad(d.getUTCHours() + 1) + ':'
		+ pad(d.getUTCMinutes()) + ':'
		+ pad(d.getUTCSeconds())
}

function turnOn(sensorID) {
	$.post("turnOn.php", { sensorID: sensorID })
		.done(function (data) {
			location.reload();
		});
};
function turnOff(sensorID) {
	$.post("turnOff.php", { sensorID: sensorID })
		.done(function (data) {
			location.reload();
		});
};

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
					<div class='panel-heading' " + '"' +  " style='cursor:pointer'> \
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

