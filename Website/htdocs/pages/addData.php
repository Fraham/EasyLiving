<?php
  function addNewData($statement)
  {
    require "connectToDatabase.php";

    $statement->execute();
  }
?>
