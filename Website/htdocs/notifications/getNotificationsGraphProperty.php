<?php
	$roomList = "";
	require_once "../src/connect.php";

	$userID = $_SESSION['user_id'];

  $statement = "SELECT houseName FROM user_households WHERE user_households.userID =  $userID";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$roomList .= "<option>";
      $roomList .= "$row[houseName]";
      $roomList .= "</option>";
		}
	}

	$conn->close();

	echo $roomList;
?>
