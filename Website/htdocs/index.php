<?php
	include_once "/src/includes/functions.php";
	include_once "/src/connect.php";

	//sec_session_start();
	session_start();

	if (login_check($conn) == true)
	{
		header('Location: dashboard');
	}
	else
	{
		header('Location: login');
	}
?>
