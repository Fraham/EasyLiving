<?php
	require_once "../src/connect.php";

	$statement = "SELECT date, AVG(light) as light, spots.zone
		FROM lightLog
		INNER JOIN spots
		ON spots.spotID = lightLog.spotID
		GROUP BY
			spots.zone,
			YEAR(date),
			MONTH(date),
			DAY(date),
			HOUR(date)
		ORDER BY spots.zone";

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

			$jsonRows[$row['zone']][] = array($year, $month, $day, $hour, 0, 0, $row['light']);
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