<?php
  require_once "../src/connect.php";

  $statement = "SELECT U.userID FROM users as U
      WHERE U.email = ? AND U.password = ?";

  //$result = $conn->query($statement);

  $result = $conn->prepare($statement);

  $result->bind_param("ss", $email, $password);

  $result->execute();

  if ($result->num_rows == 1)
  {
    $row = $result->fetch_assoc();

    echo "$row[userID]";
  }
  else
  {
    echo "no record";
  }

  $conn->close();
?>
