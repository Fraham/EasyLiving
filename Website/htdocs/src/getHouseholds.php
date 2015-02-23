<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	$statement = "SELECT";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		$tableHtml .= "<thead>
			<tr>
				<th>Room</th>
				<th>Comment</th>
				<th>Date and Time</th>
			</tr>
		</thead>";

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