<?php
	$roomList = "";
	require_once "../src/connect.php";

  $houseID = "111111";

  $statement = "SELECT dName FROM room WHERE room.houseID = $houseID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$roomList .= "<option selected>";
      $roomList .= "$row[dName]";
      $roomList .= "</option>";
		}
	}

	$conn->close();

	echo $roomList;
?>
