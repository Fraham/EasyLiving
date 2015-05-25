<?php 
	include "../src/classes/ConditionClass.php";
	
	include "../src/includes/functions.php";
	
	sec_session_start();
	
	$userID = $_SESSION['user_id'];

	$conditionName = $_POST['conditionName'];
	$userID = $_SESSION['user_id'];

	echo Condition::addCondition($conditionName, $userID);
?>