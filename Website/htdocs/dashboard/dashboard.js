
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
				var propertyData = result['data'];

				for (var t = 0; t < propertyData.length; t++)
				{
					var panel = $("<div/>", {class : "panel panel-default", id : propertyData[t]["propertyID"] + "mainPanel"}); // Remeber to change

					var heading = $("<div/>", { class : "panel-heading", style : "cursor:pointer"});

					var title = $("<h4/>", { class : "panel-title",
						'data-toggle' : "collapse",
						'data-target' : "#" + propertyData[t]["propertyID"] + "colPanel"
					});

					var bar = $("<a/>", {
						'data-toggle' : "collapse",
						'data-target' : "#" + propertyData[t]["propertyID"] + "colPanel",
						text : propertyData[t]["userName"]
					});

					title.append(bar);

					heading.append(title);

					panel.append(heading);

					var collapse = $("<div/>", {class : "panel-collapse collapse in", id : propertyData[t]["propertyID"] + "colPanel"}); // Remeber to change

					var body = $("<div/>", {class : "panel-body", id : propertyData[t]["propertyID"] + "roomsPanel"});// Remeber to change

					collapse.append(body);

					panel.append(collapse);

					$(panel).hide().appendTo("#roomsPanel").fadeIn("slow");



					var roomHTML = "";

					var roomData = propertyData[t]["roomData"];

					for (var j = 0; j < roomData.length; j++)
					{
						var sensorPanelID = roomData[j]["id"] + "sensorPanel";


						var roomMain = $("<div/>", {class : "col-md-3"});

						var colour = (roomData[j]["state"] === "Occupied" ? roomData[j]["colourOccupied"] : roomData[j]["colourUnoccupied"]);

						var roomPanel = $("<div/>", {class : "panel panel-" + colour});

						var roomHeading = $("<div/>", {
								'data-toggle' : "collapse",
								'data-target' : "#" + sensorPanelID + "colPanel",
								class : "panel-heading", style : "cursor:pointer"});

						var roomRow = $("<div/>", {class : "row"});

						var roomIconSpace = $("<div/>", {class : "col-xs-3"});

						var roomIcon = $("<i/>", {class : "fa fa-" + roomData[j]["icon"] + " fa-2x"});

						roomIconSpace.append(roomIcon);

						var roomNameSpace = $("<div/>", {class : "col-xs-9 text-right"});

						var roomName = $("<div/>", {
								'data-toggle' : "collapse",
								'data-target' : "#" + sensorPanelID + "colPanel",
								text : roomData[j]["name"]});

						var roomState = $("<div/>", {text : roomData[j]["state"]});

						roomNameSpace.append(roomName);

						roomNameSpace.append(roomState);

						roomRow.append(roomIconSpace);

						roomRow.append(roomNameSpace);

						roomHeading.append(roomRow);

						roomPanel.append(roomHeading);

						var roomCollapse = $("<div/>", {class : "panel-collapse collapse in", id : sensorPanelID + "colPanel"});

						var roomSensorPanel = $("<div/>", {class : "panel-body", id : sensorPanelID });

						roomCollapse.append(roomSensorPanel);

						roomPanel.append(roomCollapse);

						roomMain.append(roomPanel);

						$(roomMain).hide().appendTo("#" + propertyData[t]["propertyID"] + "roomsPanel").fadeIn("slow");

						if ((j + 1) % 4 === 0)
						{
							var clearfix = $("<div/>", {class : "clearfix"});
							$(clearfix).hide().appendTo("#" + propertyData[t]["propertyID"] + "roomsPanel").fadeIn("slow");
						}

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
				}

			},
			error: function (e) {
				//console.log(e);
			},
			complete: function () {

			}
		});
};

