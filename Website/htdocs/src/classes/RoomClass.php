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
}
?>