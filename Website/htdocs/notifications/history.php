<?php
	if(isset($_POST['action']) && !empty($_POST['action'])) 
	{
	    $action = $_POST['action'];
	    switch($action) 
		{
	        case 'updateSensorsList' : updateSensorsList();break;
	    }
	}
	
	function updateSensorsList()
	{
		
	}
?>