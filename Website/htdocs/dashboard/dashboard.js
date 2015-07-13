
var date = new Date("July 21, 1983 01:15:00");
var newDate = ISODateString(date);

var refreshAjax;

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

