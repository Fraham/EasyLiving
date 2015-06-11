<?php
	
class Room
{
	public $roomID = "";
	public $defaultName = "";
	public $houseID = "";
	public $colourID = "";
	public $iconID = "";	



	public static function getRoomsDrop($propertyID)
	{
		$roomList = "";

		require "../src/connect.php";
	
		$statement = "SELECT dName, roomID FROM room
		WHERE room.houseID = $propertyID";
	
		$result = $conn->query($statement);
	
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$roomList .= "<option value = ";
				$roomList .= "$row[roomID]";
				$roomList .= ">";
				$roomList .= "$row[dName]";
				$roomList .= "</option>";
			}
		}
	
		$conn->close();
		
		echo $roomList;
	}

	public static function updateRoom($roomID, $name, $colourID, $iconID)
	{
		require "../src/connect.php";

		$statement = "UPDATE room
		SET dName='$name', colourID='$colourID',iconID='$iconID'
		WHERE roomID = '$roomID'";
		
		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
	}
	
	public static function occupiedState($roomID)
	{
		require "../src/connect.php";
		
		$occupiedStatement = "SELECT state, sensorID FROM sensors
					INNER JOIN room
					ON sensors.roomID = room.roomID
					WHERE room.roomID = $roomID";
	
		$occupiedResult = $conn->query($occupiedStatement);
	
		$motion = 0;
	
		if ($occupiedResult->num_rows > 0)
		{
			while($occupiedRow = $occupiedResult->fetch_assoc())
			{
				if (0 === strpos($occupiedRow['sensorID'], '01'))
		        {
					if($occupiedRow['state'] == 1)
			        {
						$motion = 1;
					}
				}
			}
		}
	
		if ($motion == 1) //motion sensor state
		{
			$colour = "occupied";
			$state = "Occupied";
		}
		else
		{
			$colour = "unoccupied";
					
			$lastSeenStatement = "SELECT date 
					FROM log
					INNER JOIN sensors
					On sensors.sensorID = log.sensorID
					INNER JOIN room
					ON sensors.roomID = room.roomID
					WHERE room.roomID = $roomID and sensors.sensorID LIKE '01%'
					ORDER BY logID DESC
					LIMIT 1";
					
					$lastSeenResult = $conn->query($lastSeenStatement);
					
					if ($lastSeenResult->num_rows > 0)
					{
						$lastSeenRow = $lastSeenResult->fetch_assoc();
						
						$state = "Motion last detected at: ";
						
						$theDate = strtotime($lastSeenRow['date']);
						
						$state .= date("h:ia l d", $theDate);
					}
					else
					{
						$state = "No Motion Sensor";
					}			
				}
				
				return array($state, $colour);
	}
}
?>