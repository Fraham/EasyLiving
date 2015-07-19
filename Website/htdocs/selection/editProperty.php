<?php
	include "../src/classes/PropertyClass.php";

	$defaultName = $_POST['defaultName'];
	$userName = $_POST['userName'];
	$propertyID = $_POST['propertyID'];
	$propertyPassword = $_POST['password'];

	session_start();
	session_write_close();

	$userID = $_SESSION['user_id'];

	echo Property::updateProperty($userID, $defaultName, $userName, $propertyPassword, $propertyID);
?>
