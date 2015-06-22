function deleteSensor() {
	var ID = document.getElementById("sensorID").value;

	$.post("deleteSensor.php", { func: "delete", id: ID })
		.done(function (data) {
		location.reload();
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
									location.reload();
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
		location.reload();
	});
};

function openForm(sensorID, name, messageOn, messageOff, roomID) {
	document.forms["editSensorForm"]["sensorID"].value = sensorID;
	document.forms["editSensorForm"]["name"].value = name;
	document.forms["editSensorForm"]["messageOn"].value = messageOn;
	document.forms["editSensorForm"]["messageOff"].value = messageOff;
	document.forms["editSensorForm"]["room"].value = roomID;

	$('#editSensorModal').modal('show');
};