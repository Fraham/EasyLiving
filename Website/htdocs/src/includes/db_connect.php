<?php
	$servername = "localhost";
	$hostname = "easyLiving.ml";
	$username = "root";
	$password = "cheeseBurger";
	$dbname = "easyliving";

	// Create connection
	$conn = new mysqli($hostname, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>
