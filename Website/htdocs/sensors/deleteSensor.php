<?php 
	if (isset($_POST["func"]) and isset($_POST["id"]))
	{
		require "../src/connect.php";

		$id = intval($_POST['id']);
		$statement = "DELETE FROM sensors WHERE sensorID = $id";

		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
		
		$logStatement = "DELETE FROM log WHERE log.sensorID = $id";
		if (!$conn->query($logStatement)) {
			echo "Error: " . $logStatement . "<br>" . $conn->error;
		}
		
		$conn->close();
	}
?>