<?php
	require_once "../src/connect.php";
	if(isset($_GET['date'])) {
		$date= $_GET['date'];
	}
	else
	{
		$date = "1971-06-22 05:40:06";
	}

	$statement = "SELECT date, COUNT(*) as amount, items.name as name
		FROM log2
		INNER JOIN items
		ON items.itemID = log2.itemID
		WHERE log2.sensorType = 'i' AND date > '" .$date. "' 
		GROUP BY
			items.itemID,
			YEAR(date),
			MONTH(date),
			DAY(date),
			HOUR(date),
			MINUTE(date)
		ORDER BY items.itemID";

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

			$jsonRows[$row['name']][] = array($year, $month, $day, $hour, $minute, 0, $row['amount']);
		}

		$jsonResult["error"] = 0;
	}
	else
	{
		$jsonResult["error"] = $date;
	}

	$jsonResult["data"] = $jsonRows;

	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);

	$conn->close();

?>