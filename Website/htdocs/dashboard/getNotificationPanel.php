<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";

	sec_session_start();

	$houseID = $_SESSION['house_id'];
	
	$date=$_GET['date'];
	
	$endtime = time() + 20;
	$curtime = null;
	$lasttime = null;
	$newData = false;
					
	while(time() <= $endtime)
	{
		$statement = "SELECT DATE_FORMAT(date,'%k:%i') as time, sensors.messageOn, sensors.messageOff, log.state, room.dName, date
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
				$data = array();
				
				while($row = $result->fetch_assoc())
				{
					$state = (int) $row['state'];				
	
					if($state == 0)
					{
						$message = $row['messageOff'];
					}
					else
					{
						$message = $row['messageOn'];
					}
				
					$data[] = array("name" => $row['dName'], "message" => $message, "time" => $row['time'], "date" => $row['date']);
				}
				
				$curtime = strtotime($data[0]['date']);
				$lasttime = strtotime($date);
				
				if(!empty($data) && $curtime >= $lasttime)
				{
					$newData = true;
					$jsonResult['newData'] = "yes";
					$jsonResult['data'] = $data;
					break;
				}
				else{
					sleep(1);
				}
			}
	}
	if(!$newData)
	{	
		$jsonResult['newData'] = "no";
	}
	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
	
	$conn->close();
?>
