<?php	
	$tableHtml = "";
	require "connect.php";
	
	$sql = "SELECT DATE_FORMAT(time,'%k:%i:%s') as time, data FROM test ORDER BY idtest DESC LIMIT 15";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$tableHtml .= "<tr>";
        $tableHtml .= "<th>Date and Time</th>";
        $tableHtml .= "<th>Data</th>";
        $tableHtml .= "<tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$tableHtml .= "<tbody>";
			$tableHtml .= "<tr class='odd gradeX'>";
			$tableHtml .= "<td class='center'> $row[time] </td>";
			$tableHtml .= "<td class='center'> $row[data] </td>";
			$tableHtml .= "</tr>";
			$tableHtml .= "</tbody>";
		}
	}
	$conn->close();
	echo $tableHtml;
?>