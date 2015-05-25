<?php
	require "src/connect.php";
	
	
	
$getHouseStatement = "SELECT house.houseID
                		FROM house
		                INNER JOIN room
		                ON house.houseID = room.houseID
		                INNER JOIN sensors
		                ON sensors.roomID = room.roomID
		                WHERE sensors.sensorID = '070001'";
						
			$getHouseResult = $conn->query($getHouseStatement);
				
			if ($getHouseResult->num_rows > 0)
			{
				$row = $getHouseResult->fetch_assoc();
				
				$houseID = $row['houseID'];
			}
						
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
					WHERE sensors.sensorID = '070001'";

		if (!$conn->query($sql)) 
			echo "Error: " . $sql . "<br>" . $conn->error;
			
		echo "done";

		$conn->close();	
?>