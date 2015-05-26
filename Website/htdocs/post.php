<?php
	require "src/connect.php";

	if (isset($_POST["id"]) and isset($_POST["msg"]))
	{

		if (isset($_POST["temp"]))
			$sql = "INSERT INTO tempHum (sensorID, temp, hum) VALUES (".$_POST['id'].", ".$_POST['temp'].", ".$_POST['hum'].")";
		else if ($_POST["msg"] == "request")
		{
			$houseID = getHouseID($conn);

			$sql = "SELECT sensorID	FROM sensors WHERE done = 0";

			$result = $conn->query($sql);
			if (!$result) 
				echo "Error: " . $sql . "<br>" . $conn->error;

			$todo = "";
			while ($row = $result->fetch_assoc())
			{
				if (substr($row['sensorID'], 0, 2) === "08")
				{
					$query = "SELECT messageOn FROM sensors WHERE sensorID = ".$row['sensorID']."";
					$field = "messageOn";
				}
				else
				{
					$query = "SELECT state FROM sensors WHERE sensorID = ".$row['sensorID']."";
					$field = "state";
				}

				$result2 = $conn->query($query); 
				if (!$result2) 
					echo "Error: " . $query . "<br>" . $conn->error;
				$row2 = $result2->fetch_assoc();
				echo $row['sensorID'] + ": " + $row2[$field] + ";";
			}

			return 0;
		}
		else if(strlen($_POST["msg"]) == 1)
		{
			$statement = "UPDATE sensors SET state = '".$_POST['msg']."' WHERE sensorID = '".$_POST['id']."';";

			if (!$conn->query($statement)) 
				echo "Error: " . $statement . "<br>" . $conn->error;

			$sql = "INSERT INTO log (sensorID, state)
			VALUES (".$_POST['id'].", ".$_POST['msg'].")";
		}
		else if ($_POST["msg"] == "allow")
			$sql = "UPDATE sensors SET assigned = 2 WHERE sensorID = '".$_POST['id']."' AND assigned = 1;";
		else if ($_POST["msg"] == "sysCheck")
		{
			
			$houseID = getHouseID($conn);
						
			$statement = "SELECT sensors.name, room.dName
                		FROM sensors
		                INNER JOIN room
		                ON sensors.roomID = room.roomID
		                INNER JOIN house
		                ON room.houseID = house.houseID
		                WHERE house.houseID = $houseID
						AND sensors.sensorID LIKE '02%'
		                AND state = 1";
						
			$result = $conn->query($statement);
			
			$onMessage = "";
				
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				
				$onMessage = "{$row['name']} - {$row['dName']}";
			}
			else
			{
				$onMessage = "Secure";
			}
			
			$sql = "UPDATE sensors
					SET messageOn = '$onMessage', done = '0'
					WHERE sensors.sensorID = '".$_POST['id']."'";
		}

		if (!$conn->query($sql)) 
			echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
	}

	function getHouseID($conn)
	{
		$getHouseStatement = "SELECT house.houseID
							  FROM house
							  INNER JOIN room
							  ON house.houseID = room.houseID
							  INNER JOIN sensors
							  ON sensors.roomID = room.roomID
							  WHERE sensors.sensorID = '".$_POST['id']."'";

		$getHouseResult = $conn->query($getHouseStatement);

		if ($getHouseResult->num_rows > 0)
		{
			$row = $getHouseResult->fetch_assoc();
			$houseID = $row['houseID'];
		}
		return $houseID;
	}

	function display()
	{
		$file = 'arduino.txt';
		$current = "pressed";
		file_put_contents($file, $current);
	}
?>
