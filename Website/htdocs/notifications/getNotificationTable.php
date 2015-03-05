<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";

	sec_session_start();

	$houseID = $_SESSION['house_id'];

	$statement = "SELECT room.dName, log.comment, DATE_FORMAT(log.date,'%d %b %Y %T') as time, sensors.name as sensorName
		FROM log
		INNER JOIN sensors
		ON log.sensorID = sensors.sensorID
		INNER JOIN room
		ON sensors.roomID = room.roomID
		INNER JOIN house
		ON room.houseID = house.houseID
    WHERE house.houseID = $houseID
		ORDER BY logID DESC LIMIT 20";

	$result = $conn->query($statement);

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
	else
	{
		$tableHtml .= "$houseID";
		$tableHtml .= " no results";
	}

	$conn->close();

	echo $tableHtml;
?>
