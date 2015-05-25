<?php 
	if (isset($_POST["func"]) and isset($_POST["id"]))
	{
		require "../src/connect.php";
		
		$id = intval($_POST['id']);
		
		$statement2 = "SELECT houseID
					FROM room
					WHERE roomID = $id";
					
		$result = $conn->query($statement2);

		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			
			$houseID = $row["houseID"];
			
			$statement3 = "SELECT roomID
							FROM room
							WHERE room.houseID = '$houseID'
							AND room.dName = 'Unallocated Sensors'";
							
			$result = $conn->query($statement3);

			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				
				$newRoomID = $row["roomID"];
			
				$statement4 = "UPDATE sensors
						SET roomID = '$newRoomID'
						WHERE roomID = $id";
						
				$result = $conn->query($statement4);
			}
		}

		
		$statement = "DELETE FROM room WHERE roomID = $id";

		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
		$conn->close();
	}
?>