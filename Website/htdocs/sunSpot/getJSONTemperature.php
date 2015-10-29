<?php
	require_once "../src/connect.php";

	$statement = "SELECT date, AVG(data) as temperature, zone
		FROM log2
		WHERE log2.sensorType = 't'
		GROUP BY
			zone,
			YEAR(date),
			MONTH(date),
			DAY(date),
			HOUR(date),
			MINUTE(date)
		ORDER BY zone";

	$result = $conn->query($statement);

	$jsonRows = array();

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$year = substr($row['date'], 0, 4);
			$month = substr($row['date'], 5, 2);
			$day = substr($row['date'], 8, 2);
			$hour = substr($row['date'], 11, 2);
			$minute = substr($row['date'], 14, 2);

			$jsonRows[$row['zone']][] = array($year, $month, $day, $hour, $minute, 0, $row['temperature']);
		}

		$jsonResult["error"] = 0;
	}
	else
	{
		$jsonResult["error"] = 1;
	}

	$jsonResult["data"] = $jsonRows;

	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);

	$conn->close();

?>