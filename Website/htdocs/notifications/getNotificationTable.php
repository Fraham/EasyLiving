<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";

	sec_session_start();

	$houseID = $_SESSION['house_id'];

	$statement = "SELECT room.dName, DATE_FORMAT(log.date,'%d %M %Y %T') as time, sensors.name  as sensorName, sensors.messageOn, sensors.messageOff, log.state
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
				<th>Room</th>
				<th>Sensor Name</th>
				<th>Message</th>
				<th>Date and Time</th>
			</tr>
		</thead>";

		while($row = $result->fetch_assoc())
		{
			$state = (int) $row["state"];
			$message = "";

			if($state == 0)
			{
				$message = $row['messageOff'];
			}
			else
			{
				$message = $row['messageOn'];
			}

			$tableHtml .= "<tbody>";
			$tableHtml .= "<tr>";
			$tableHtml .= "<td class='center'> $row[dName] </td>";
			$tableHtml .= "<td class='center'> $row[sensorName] </td>";
			$tableHtml .= "<td class='center'> $message </td>";
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
