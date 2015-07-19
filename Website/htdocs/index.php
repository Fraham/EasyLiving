<?php
	include_once "/src/connect.php";

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
