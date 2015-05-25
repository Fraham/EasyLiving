<?php
	if (isset($_POST["propertyID"]) and isset($_POST["housePassword"]))
	{
		require_once "../includes/functions.php";
		sec_session_start();
		
		$propertyID = $_POST['propertyID'];
		$housePassword = $_POST['housePassword'];
		
		require "../connect.php";
	
		$userID = $_SESSION['user_id'];
		
		$statement = "SELECT houseID, house_password, dName
						FROM house
						WHERE houseID = $propertyID";
						
		$result = $conn->query($statement);
		
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			
			if(strcmp($row['house_password'], $housePassword) === 0)
			{
				$name = $row['dName'];
				$insertStatement = "INSERT INTO user_households
							VALUES ('$name', '$userID', '$propertyID')";
				
				if (!$conn->query($insertStatement)) {
					echo "Error: " . $insertStatement . "<br>" . $conn->error;
				}
				}
		
			}
		}
		$conn->close();
	}
?>