<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";

	sec_session_start();

	$houseID = $_SESSION['house_id'];
	
	$date=$_GET['date'];
	
	$jsonResult['date'] = $date;		
	
	$checkDateStatement = "SELECT log.date
						FROM log
		 				INNER JOIN sensors
						ON log.sensorID = sensors.sensorID
						INNER JOIN room
						ON sensors.roomID = room.roomID
						INNER JOIN house
						ON room.houseID = house.houseID
						WHERE house.houseID = $houseID
						AND log.date > '$date'
						AND sensors.sensorID NOT LIKE '01%'
	          			ORDER BY logID DESC
						LIMIT 1";
	
	$checkDateResult = $conn->query($checkDateStatement);

	if ($checkDateResult->num_rows > 0)
	{				
		$jsonResult['newData'] = "yes";
		
		$statement = "SELECT DATE_FORMAT(date,'%k:%i') as time, sensors.messageOn, sensors.messageOff, log.state, room.dName
						FROM log
		 				INNER JOIN sensors
						ON log.sensorID = sensors.sensorID
						INNER JOIN room
						ON sensors.roomID = room.roomID
						INNER JOIN house
						ON room.houseID = house.houseID
						WHERE house.houseID = $houseID
						AND sensors.sensorID NOT LIKE '01%'
	          			ORDER BY logID DESC
						LIMIT 10";
	
		$result = $conn->query($statement);
	
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$state = (int) $row['state'];
				//$message = "{$row['dName']} - ";
	
				if($state == 0)
				{
					$message = $row['messageOff'];
				}
				else
				{
					$message = $row['messageOn'];
				}
	
				/*$tableHtml .= "<a href='#' class='list-group-item'>";//<i class='fa fa-comment fa-fw'></i>";
				$tableHtml .= $message;
				$tableHtml .= "<span class='pull-right text-muted small'><em>";
				$tableHtml .= "$row[time]";
				$tableHtml .= "</em></span>";*/
				
				$data = array("name" => $row['dName'], "message" => $message, "date" => $row['time']);
				
				$jsonResult['data'][] = $data;
			}
		}
	}
	else
	{
		$jsonResult['newData'] = "no";
	}
	$conn->close();
	
	//$jsonResult['data'] = $tableHtml;
	
	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
?>
