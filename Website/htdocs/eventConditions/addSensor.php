<?php
	include "../src/classes/ConditionClass.php";

	include "../src/includes/functions.php";

	//sec_session_start();
	session_start();
	session_write_close();

	$userID = $_SESSION['user_id'];

	$conditionName = $_POST['conditionName'];
	$userID = $_SESSION['user_id'];
//not done
	echo Condition::addCondition($conditionName, $userID);
?>