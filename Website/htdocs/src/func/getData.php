<?php
  function getData($statement)
  {
    require_once "../../src/connect.php";

    $statement->execute();

    $conn->close();
  }

  function getNotifications($sensorID, $startDate, $endDate)
  {
    $statement = "SELECT COUNT(*) as Amount, DATE(date) as Date, hour(date) as Time
	   FROM log
     WHERE log.sensorID = $sensorID
     AND date BETWEEN '$startDate' AND '$endDate'
     GROUP BY YEAR(date), MONTH(date), DAY(date), Time
     ORDER BY log.logID
     DESC LIMIT 1000;";

    $result = $conn->query($statement);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {

      }
    }

    $conn->close();
  }
?>
