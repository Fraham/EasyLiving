<?php
  require_once "../src/connect.php";

  //$userID = $_SESSION['user_id'];

  $statement = "SELECT date, state FROM log ORDER BY logID DESC LIMIT 100";

  $result = $conn->query($statement);

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
      echo $row['date'] . "\t" . $row['state']. "\r\n";
    }
  }

  $conn->close();
?>
