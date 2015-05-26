<?php
	require_once "../src/connect.php";
	
	$sensorID = $_POST['sensorID'];
	
	echo $sensorID;
	
	$statement = "UPDATE sensors
				SET done='0', state = '1'
				WHERE sensors.sensorID = '$sensorID'";
				
	if (!$conn->query($statement)) {
		echo "Error: " . $statement . "<br>" . $conn->error;
	}
	else
	{
		echo "done";
	}
?>