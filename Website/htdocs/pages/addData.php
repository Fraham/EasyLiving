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

  function addNewHouse($houseID, $house_password)
  {
    require "../connect.php";

    $statement = $conn->prepare("INSERT INTO house (houseID, house_name) VALUES (?, ?)");

    $statement->bind_param("ss", $houseID, $house_password);

    addNewData($statement);

    $conn->close();
  }

  function addNewRoom($sensorID, $name, $messageOn, $messageOff, $roomID)
  {
    require "../connect.php";

    $statement = $conn->prepare("INSERT INTO sensors (sensorID, name, messageOn, messageOff, roomID) VALUES (?, ?, ?, ?, ?)");

    $statement->bind_param("isssi", $sensorID, $name, $messageOn, $messageOff, $roomID);

    addNewData($statement);

    $conn->close();
  }

  function addNewUser($userID, $email, $password)
  {
    require "../connect.php";

    $statement = $conn->prepare("INSERT INTO sensors (userID, email, password) VALUES (?, ?, ?)");

    $statement->bind_param("iss", $userID, $email, $password);

    addNewData($statement);

    $conn->close();
  }
?>
