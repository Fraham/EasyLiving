<?php
	$roomList = "";
	require_once "../src/connect.php";

	$houseID = $_SESSION['house_id'];

  $statement = "SELECT dName FROM room WHERE room.houseID = $houseID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$roomList .= "<option>";
      $roomList .= "$row[dName]";
      $roomList .= "</option>";
		}
	}

	$conn->close();

	echo $roomList;
?>