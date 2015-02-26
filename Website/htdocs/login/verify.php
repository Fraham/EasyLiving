<?php
  require_once "../src/connect.php";

  $statement = "SELECT U.userID FROM users as U
      WHERE U.email = $email AND U.password = $password";

  $result = $conn->query($statement);

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
