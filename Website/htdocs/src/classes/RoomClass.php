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
}
?>