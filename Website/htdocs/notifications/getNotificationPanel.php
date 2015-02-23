<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	$statement = "SELECT rooms.room_name, log.comment, SELECT DATE_FORMAT(log.date,'%k:%i') as time, sensor_types.sensor_type_name FROM log
		INNER JOIN sensors
		ON log.sensor_id = sensors.idsensors
		INNER JOIN sensor_types
		ON sensors.sensor_type = sensor_types.idsensor_types
		INNER JOIN rooms
		ON sensors.room_id = rooms.idrooms
		ORDER BY logID DESC LIMIT 20";

	$result = $conn->query($statement);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			tableHtml .= "<tbody>";
			tableHtml .= "<tr class='odd gradeX'>";
			tableHtml .= "<td class='center'> $row[room_name] </td>";
			tableHtml .= "<td class='center'> $row[comment] </td>";
			tableHtml .= "<td class='center'> $row[date] </td>";
			tableHtml .= "<td class='center'> $row[sensor_type_name] </td>";
			tableHtml .= "</tr>";
			tableHtml .= "</tbody>";
		}
	}
	$conn->close();
?>
