<?php 
	class Condition
	{
		public $eventID = "";
		public $conditionName = "";

		public static function addCondition($name, $user_ID)
		{
			require "../src/connect.php";

			$statement = "INSERT INTO event (name, userID) VALUES ('$name','$user_ID')";
			
			if (!$conn->query($statement)) {
				echo "Error: " . $statement . "<br>" . $conn->error;
			}
			else
			{
				echo "created";
			}

		}
	}
?>