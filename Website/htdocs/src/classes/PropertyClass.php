<?php

class Property
{
  public $houseID = "xxxxxx";
  public $password = "";
  public $defaultName = "";
  public $userName = "";
  
  public $rooms = [];

  public static function getByUserID($userID)
  {
    require "../src/connect.php";

    $properties = [];

    $statement = "SELECT house.houseID, house.house_password, house.dName, user_households.houseName
                  FROM house
                  INNER JOIN user_households
                  ON house.houseID = user_households.houseID
                  WHERE user_households.userID = $userID";

    $result = $conn->query($statement);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $property = new Property;
        $property->houseID     = $row['houseID'];
        $property->password    = $row['house_password'];
        $property->defaultName = $row['dName'];
        $property->userName    = $row['houseName'];

        $properties[] = $property;
      }
    }

    return $properties;
  }

  public function __getTableFormat()
  {
    $tableHTML = <<<HTML
    <tbody>
    <tr class='odd gradeX'>
    <td>{$this->houseID}</td>
    <td>{$this->password}</td>
    <td>{$this->defaultName}</td>
    <td>{$this->userName}</td>
    </tr>
    </tbody>
HTML;

    echo $tableHTML;
  }

  public function getMenu($path)
  {
    $houseID = $_SESSION['house_id'];

    $button = "";

    if (strcmp($houseID, $this->houseID) !== 0)
    {
      $button = "btn-default";
    }
    else
    {
      $button = "btn-danger";
    }

    $menuHTML = <<<HTML
    <div>
      <input onclick="clickButton{$this->houseID}()" type="button" id="houseMenu" value="{$this->userName}"class="btn btn-md {$button} btn-block" style="margin-top:5px;"></input>
    </div>
    <script>
      function clickButton{$this->houseID}(){
        $.post("{$path}changeHouse.php", { func: "changeHouse", houseID: "{$this->houseID}", user_id: "{$_SESSION['user_id']}" })
  			.done(function( data ) {
  				location.reload();
          console.log(data);
  			});
      }
    </script>
HTML;

    echo $menuHTML;
  }
  
  public static function getNextID()
  {
    require "../src/connect.php";
    
    $statement = "SELECT MAX(houseID) AS houseID 
                  FROM house";
                  
    $result = $conn->query($statement);

    if ($result->num_rows > 0)
    {             
      $row = $result->fetch_assoc();
      
      $newID = $row["houseID"] + 1;      
    }
    else
    {
      $newID = "111111";
    }
    
    return ("$newID");
  }
  
  public static function saveProperty($userID, $name, $housePassword, $houseID)
  {
      require_once "../src/connect.php";
  
      $insertStatement = "INSERT INTO house
      (houseID, house_password, dName)
      VALUES ($houseID, $housePassword, $name)";
  
      $conn->execute($insertStatement);
  
      $insertStatement = "INSERT INTO userHouseholds
      (userID, houseID)
      VALUES ($userID, $houseID)";
  
      $conn->execute($insertStatement);
  }
}

?>
