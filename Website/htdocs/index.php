<?php
	include_once "/src/connect.php";
	include_once "/src/includes/functions.php";

	session_start();
	session_write_close();

	if (login_check($conn) == true)
	{
		header('Location: dashboard');
	}
	else
	{
		header('Location: login');
	}
?>
