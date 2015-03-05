<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";

	sec_session_start();

	$houseID = $_SESSION['house_id'];

	$statement = "SELECT DATE_FORMAT(date,'%k:%i') as time, comment FROM log
	 				INNER JOIN sensors
					ON log.sensorID = sensors.sensorID
					INNER JOIN room
					ON sensors.roomID = room.roomID
					INNER JOIN house
					ON room.houseID = house.houseID
					WHERE house.houseID = $houseID
          ORDER BY logID
					DESC LIMIT 10";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()) {
			$tableHtml .= "<a href='#' class='list-group-item'>";//<i class='fa fa-comment fa-fw'></i>";
			$tableHtml .= "$row[comment]";
			$tableHtml .= "<span class='pull-right text-muted small'><em>";
			$tableHtml .= "$row[time]";
			$tableHtml .= "</em></span>";
		}
	}
	$conn->close();
	echo $tableHtml;
?>

<!--					fa fa-comment fa-fw
						fa fa-twitter fa-fw
						fa fa-envelope fa-fw
						fa fa-tasks fa-fw
						fa fa-upload fa-fw
						fa fa-bolt fa-fw
						fa fa-warning fa-fw
						fa fa-shopping-cart fa-fw
						fa fa-money fa-fw-->
