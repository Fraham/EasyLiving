<?php  
	include "../src/classes/SensorClass.php";
     
	$sensorID = $_POST['sensorID'];

	echo Sensor::checkSensor($sensorID);  
?>