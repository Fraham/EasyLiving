<?php
  function addNewData($statement)
  {
    require "../connect.php";

    $statement->execute();
  }
?>
