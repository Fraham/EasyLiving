<?php 
	if (isset($_POST["func"]) and isset($_POST["id"]))
	{
		require "../src/connect.php";

		$id = intval($_POST['id']);
		$statement = "DELETE FROM room WHERE roomID = $id";

		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
		$conn->close();
	}
?>