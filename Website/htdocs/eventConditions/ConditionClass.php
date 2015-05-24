<?php 
	class Condition
	{
		public $conditionName = "";
		public $eventID = "";

		public static function addCondition($name, $userID)
		{
			require "../src/connect.php";

			$statement = "INSERT INTO event
						  (name, userID)
						  VALUES ('$name','$userID')";
			if (!$conn->query($statement)) {
				echo "Error: " . $statement . "<br>" . $conn->error;
			}
			$conn->close();

		}
	}
?>