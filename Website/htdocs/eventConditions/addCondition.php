<?php 
	include "../src/classes/ConditionClass.php";

	$conditionName = $_POST['conditionName'];
	$userID = $_SESSION['user_id'];

	echo Condition::addCondition($conditionName, $userID);
?>