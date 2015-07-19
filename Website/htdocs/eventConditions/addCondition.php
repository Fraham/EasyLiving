<?php
	include "../src/classes/EventClass.php";

	session_start();
	session_write_close();

	$userID = $_SESSION['user_id'];

	$conditionName = $_POST['conditionName'];
	$userID = $_SESSION['user_id'];

	echo Event::addEvent($conditionName, $userID);
?>