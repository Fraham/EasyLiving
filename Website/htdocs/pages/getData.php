<?php
  function getData($statement)
  {
    require_once "../connect.php";

    $statement->execute();

    $conn->close();
  }


  
?>
