<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	$statement = "SELECT room.dName, log.comment, DATE_FORMAT(log.date,'%k:%i') as time FROM log
		INNER JOIN sensors
		ON log.sensorID = sensors.sensorID
		INNER JOIN room
		ON sensors.roomID = room.roomID
		ORDER BY logID DESC LIMIT 20";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$tableHtml .= "<tbody>";
			$tableHtml .= "<tr class='odd gradeX'>";
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
