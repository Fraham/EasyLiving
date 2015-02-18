<?php
  function addNewSensor($sensorID, $name, $messageOn, $messageOff, $roomID)
  {
    require "../connect.php";
    require "addData.php";

    $statement = $conn->prepare("INSERT INTO sensors (sensorID, name, messageOn, messageOff, roomID) VALUES (?, ?, ?, ?, ?)");

    $statement->bind_param("isssi", $sensorID, $name, $messageOn, $messageOff, $roomID);

    addNewData($statement);

    $conn->close();
  }

  //addNewSensor(2, "something", "hello", "bye", 1);
?>
