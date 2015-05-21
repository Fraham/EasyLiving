<?php  
	include "../src/classes/SensorClass.php";
     
	$sensorID = $_POST['sensorID'];
	$name = $_POST['name']; 
	$messageOn = $_POST['messageOn'];
	$messageOff = $_POST['messageOff'];
	$roomID = $_POST['room'];

	echo Sensor::updateSensor($sensorID, $name, $messageOn, $messageOff, $roomID);  
?>
