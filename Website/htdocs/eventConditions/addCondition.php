<?php 
	include "../src/classes/EventClass.php";
	
	include "../src/includes/functions.php";
	
	sec_session_start();
	
	$userID = $_SESSION['user_id'];

	$conditionName = $_POST['conditionName'];
	$userID = $_SESSION['user_id'];

	echo Event::addEvent($conditionName, $userID);
?>