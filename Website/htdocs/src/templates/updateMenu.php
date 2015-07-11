<?php
	require_once('../classes/PropertyClass.php');

	session_start();

	$userID = $_SESSION['user_id'];
	$houseID = $_SESSION['house_id'];

	$properties = [];

	$properties = Property::getByUserID($userID, 1);

	$jsonResult['currentHouse'] = $houseID;
	$jsonResult['userID'] = $userID;

	foreach($properties as $property)
	{
		$jsonResult['data'][] = array("houseID" => $property->houseID, "userName" => $property->userName);
	}

	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);

?>