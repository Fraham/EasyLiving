<?php  
	include "../src/classes/PropertyClass.php";
     
	$defaultName = $_POST['defaultName'];
	$userName = $_POST['userName']; 
	$propertyID = $_POST['propertyID'];	
	$propertyPassword = $_POST['password'];
	
	include "../src/includes/functions.php";
	
	echo "test";

	sec_session_start();
	
	$userID = $_SESSION['user_id'];

	echo Property::updateProperty($userID, $defaultName, $userName, $propertyPassword, $propertyID);  
?>
