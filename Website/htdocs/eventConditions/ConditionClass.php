<?php 
	class Condition
	{
		public $conditionName = "";
		public $eventID = "";

		public static function addCondition($name, $userID)
		{
			require_once "../src/connect.php";

			$statement = $conn->prepare("INSERT INTO event
						  (name, userID)
						  VALUES (?,?)");
			
			$statement->bind_param("si", $name, $userID);
			
			addNewData ($statement);
			

			$conn->close();

		}
	}
?>