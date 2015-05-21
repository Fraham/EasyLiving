<?php 
	include "../src/classes/roomClass.php";

	$roomID = $_POST['roomID'];
	$roomName = $_POST['name'];
	$roomColour = $_POST['colour'];
	$roomIcon = $_POST['icon'];

	echo Room::updateRoom($roomID, $roomName, $roomColour, $roomIcon);
?>