<?php

class Property
{
  public $houseID = "xxxxxx";
  public $password = "";
  public $defaultName = "";
  public $userName = "";

  public function __construct($houseID, $password, $defaultName, $userName)
  {
    $this->$houseID = $houseID;
    $this->$password = $password;
    $this->$defaultName = $defaultName;
    $this->$userName = $userName;
  }

  public function __getTableFormat()
  {
    
  }
}

?>
