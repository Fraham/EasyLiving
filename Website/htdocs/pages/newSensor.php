<?php
  function addNewSensor($sensorID, $name, $messageOn, $messageOff, $roomID)
  {
    require "connectToDatabase.php";

    $statement = $conn->prepare("INSERT INTO sensors (sensorID, name, messageOn, messageOff, roomID) VALUES (?, ?, ?, ?, ?)");

    $statement->bind_param("isssi", $sensorID, $name, $messageOn, $messageOff, $roomID);

    $statement->execute();
  }

  addNewSensor(1, "something", "hello", "bye", 1);
?>
