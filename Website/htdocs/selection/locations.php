<?php
	session_start();
	session_write_close();
	require_once('../src/classes/PropertyClass.php');

	$userID = $_SESSION['user_id'];

	$properties = [];

	$properties = Property::getByUserID($userID);

	foreach ($properties as $property)
	{
		$jsonResult['data'][] = array("houseID" => $property->houseID, "userName" => $property->userName, "password" => $property->password, "defaultName" => $property->defaultName);
	}

	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
?>