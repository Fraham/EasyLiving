<?php
	include "../src/classes/ConditionClass.php";
	
	session_start();
	session_write_close();

	$userID = $_SESSION['user_id'];

	$conditionName = $_POST['conditionName'];
	$userID = $_SESSION['user_id'];
//not done
	echo Condition::addCondition($conditionName, $userID);
?>