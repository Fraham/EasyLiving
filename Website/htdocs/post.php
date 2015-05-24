<?php
	if (isset($_POST["msg"]) and isset($_POST["id"]))
	{
		require "src/connect.php";

		if(strlen($_POST["id"]) == 1)
		{
			$statement = "UPDATE sensors SET state = '".$_POST['msg']."' WHERE sensorID = '".$_POST['id']."';";

			if (!$conn->query($statement)) {
				echo "Error: " . $statement . "<br>" . $conn->error;
			}

			$sql = "INSERT INTO log (sensorID, state)
			VALUES (".$_POST['id'].", ".$_POST['msg'].")";
		}
		else if ($_POST["msg"] == "allow")
		{
			display();
		}

		// if (!$conn->query($sql)) {
		// 	echo "Error: " . $sql . "<br>" . $conn->error;
		// }

		// $conn->close();
	}

	function display()
	{
		$file = 'arduino.txt';
		$current = "pressed";
		file_put_contents($file, $current);
	}
?>
