<?php
  function addNewData($statement)
  {
    require "../connect.php";

    $statement->execute();

    $conn->close();
  }

  function addNewSensor($sensorID, $name, $messageOn, $messageOff, $roomID)
  {
    require "../connect.php";

    $statement = $conn->prepare("INSERT INTO sensors (sensorID, name, messageOn, messageOff, roomID) VALUES (?, ?, ?, ?, ?)");

    $statement->bind_param("isssi", $sensorID, $name, $messageOn, $messageOff, $roomID);

    addNewData($statement);

    $conn->close();
  }
?>
