<?php
	if (isset($_GET["houseID"]))
	{
		include_once "../src/includes/functions.php";
	
		sec_session_start();
		
		$houseID = $_GET["houseID"];
		
		$_SESSION['house_id'] = $houseID;
	}	
?>