/*$(document).ready(function () {
    getSensors();
});*/

getSensors();

function deleteSensor() {
	var ID = document.getElementById("sensorID").value;

	$.post("deleteSensor.php", { func: "delete", id: ID })
		.done(function (data) {
		//$('#modal').modal('toggle');
		//location.reload();
		getSensors();
	});
};
function submitForm() {
	var sensorID = document.getElementById("id").value;

	console.log(sensorID);

	$.post("checkSensor.php", { sensorID: sensorID })
		.done(function (data) {
		if (data == "sensor is locked") {
			alert("Sensor Locked");
			return;
		}
		else if (data == "sensor is blocked") {
			alert("Sensor Blocked");
			return;
		}
		else if (data == "unknown sensor") {
			alert("1 - Unknown Sensor");
			return;
		}
		else {
			$.post('blockSensor.php', { sensorID: sensorID })
				.done(function (data) {
				if (data == "not able to blocked") {
					alert("Not able to block the sensor");
					return;
				}
				else if (data == "unknown sensor") {
					alert("2 - Unknown Sensor");
					return;
				}
				else {
					alert("Please press the button on the sensor.");
					//open model
					var done = false;

					var startTime = new Date().getTime();
					var interval = setInterval(function () {
						if (new Date().getTime() - startTime > 180 * 1000 || done) {
							clearInterval(interval);
							if (done == true) {
								$.post('addSensor.php', $('#addSensorForm').serialize())
									.done(function (data) {
									//location.reload();
									$('#AddModal').modal('toggle');
									getSensors();
								});
							}
							else {
								$.post('resetSensor.php', { sensorID: sensorID })
									.done(function (data) {
									alert("Adding the sensor has failed due to timeout.");
								});
							}

							return;
						}
						$.post('checkSensor.php', { sensorID: sensorID })
							.done(function (data) {
							if (data == "sensor is locked") {
								done = true;
							}
							else {
								done = false;
							}
						});
					}, 2000);
				}
			});
		}
	});
};
function checkedLocked(sensorID) {

};

function editSensor() {
	$.post('editSensor.php', $('#editSensorForm').serialize())
		.done(function (data) {
		//location.reload();
		$('#editSensorModal').modal('toggle');
		getSensors();
	});
};

function openForm(sensorID, name, messageOn, messageOff, roomID) {
	$('#sensorIDEdit').val(sensorID);
	$('#nameEdit').val(name);
	$('#messageOnEdit').val(messageOn);
	$('#messageOffEdit').val(messageOff);
	$('#roomEdit').val(roomID);

	$('#editSensorModal').modal('show');
};

function getSensors() {
	$("#sensorsPanel").empty();
	$.ajax(
		{
			url: 'getSensors.php',
			dataType: 'json',
			async: true,
			success: function (result)
			{
				var sensorHTML = "";

				var roomData = result['data'];

				for (var j = 0; j < roomData.length; j++)
				{
					sensorHTML = "";
					sensorHTML += "<div class='col-sm-4'> \
					<div class='panel panel-" + roomData[j]["colour"] + "'> \
						<div class='panel-heading'' > \
							" + roomData[j]["name"] +  " \
						</div> \
						<div class='panel-body'id='chartBody'> ";

					var sensorData = roomData[j]["sensorData"];

					sensorHTML += sensorData;

					/*for(var i = 0; i < sensorData.length; i++)
					{

					}*/
					sensorHTML += "</div></div></div>";

					if ((j + 1) % 3 === 0)
						sensorHTML += "<div class='clearfix'>";

					$(sensorHTML).hide().appendTo("#sensorsPanel").fadeIn("slow");
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
	getSensors();
}