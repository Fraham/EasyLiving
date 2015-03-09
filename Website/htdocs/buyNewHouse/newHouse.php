<?php
  require_once "../src/connect.php";

  $houseID = "";
  $housePassword = "";
  $houseName = "";
  $userID = $_SESSION['user_id'];;

  $statement = "SELECT * from house
                WHERE houseID = $houseID";

  $result = $conn->query($statement);

  if ($result->num_rows > 0)
  {
    $insertStatement = "INSERT INTO house
    (houseID, house_password, dName)
    VALUES ($houseID, $housePassword, $houseName)";

    $conn->execute($insertStatement);

    $insertStatement = "INSERT INTO userHouseholds
    (userID, houseID)
    VALUES ($userID, $houseID)";

    $conn->execute($insertStatement);
  }
  else
  {

  }
?>
