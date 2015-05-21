<?php  
	include "../src/classes/PropertyClass.php";
      
	$propertyID = Property::getNextID();
	$propertyName = $_POST['pName'];
	$housePassword = $_POST['password'];
	
	include "../src/includes/functions.php";

	sec_session_start();
	
	$userID = $_SESSION['user_id'];

	Property::saveProperty($userID, $propertyName, $housePassword, $propertyID);  
?>
