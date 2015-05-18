<?php
	if (isset($_GET["houseID"]))
	{
		include_once "../src/includes/functions.php";
	
		sec_session_start();
		
		$_SESSION['house_id'] = $_GET["houseID"];
	}
	
?>