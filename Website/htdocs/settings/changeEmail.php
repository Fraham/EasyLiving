<?php	
	if (isset($_POST["email"]) and isset($_POST["userID"]))
	{
		require "../src/connect.php";

		$userID = $_POST['userID'];
		$email = $_POST['email'];
		
		$statement = "UPDATE users
		SET email = '$email'
		WHERE userID = '$userID'";

		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
		
		$conn->close();
	}
?>