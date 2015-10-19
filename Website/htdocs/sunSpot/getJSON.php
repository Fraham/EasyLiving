<?php
	require_once "../src/connect.php";

	$statement = "SELECT date, AVG(temperature) as temperature, spots.zone
		FROM temperatureLog
		INNER JOIN spots
		ON spots.spotID = temperatureLog.spotID
		GROUP BY
			spots.zone,
			YEAR(date),
			MONTH(date),
			DAY(date),
			HOUR(date)";

	$result = $conn->query($statement);

	$jsonRows = array();

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$jsonRows[$row['zone']][] = array($row['date'], $row['temperature']);
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