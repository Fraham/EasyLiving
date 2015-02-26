<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	$statement = "SELECT room.dName, log.comment, DATE_FORMAT(log.date,'%k:%i') as time, sensors.name as sensorName
		FROM log
		INNER JOIN sensors
		ON log.sensorID = sensors.sensorID
		INNER JOIN room
		ON sensors.roomID = room.roomID
		INNER JOIN house
		ON room.houseID = ?
		ORDER BY logID DESC LIMIT 20";

	$result = $conn->prepare($statement);

	$result->bind_param("s", $houseID);

	$result->execute();

	if ($result->num_rows > 0)
	{
		$tableHtml .=
		"<thead>
			<tr>
				<th>Sensor Name</th>
				<th>Room</th>
				<th>Comment</th>
				<th>Date and Time</th>
			</tr>
		</thead>";

		while($row = $result->fetch_assoc())
		{
			$tableHtml .= "<tbody>";
			$tableHtml .= "<tr class='odd gradeX'>";
			$tableHtml .= "<td class='center'> $row[sensorName] </td>";
			$tableHtml .= "<td class='center'> $row[dName] </td>";
			$tableHtml .= "<td class='center'> $row[comment] </td>";
			$tableHtml .= "<td class='center'> $row[time] </td>";
			$tableHtml .= "</tr>";
			$tableHtml .= "</tbody>";
		}
	}

	$conn->close();

	echo $tableHtml;
?>
