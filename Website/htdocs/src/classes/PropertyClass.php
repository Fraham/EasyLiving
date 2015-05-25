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
    <td><input type="button" value="Show Password" class="btn btn-danger btn-block" onClick='showPassword("{$this->password}")'/></td> 
    <td>{$this->defaultName}</td>
    <td>{$this->userName}</td>
    <td><input type="button" value="Edit" class="btn btn-danger btn-block" onClick='showForm("{$this->houseID}", "{$this->password}", "{$this->defaultName}", "{$this->userName}")'/></td>
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
      require "../src/connect.php";
  
      $insertStatement = "INSERT INTO house
      (houseID, house_password, dName)
      VALUES ('$houseID', '$housePassword', '$name')";
  
      if (!$conn->query($insertStatement)) {
				echo "Error: " . $insertStatement . "<br>" . $conn->error;
			}
  
      $insertStatement = "INSERT INTO user_households
      (houseName, userID, houseID)
      VALUES ('$name', '$userID', '$houseID')";
  
      if (!$conn->query($insertStatement)) {
				echo "Error: " . $insertStatement . "<br>" . $conn->error;
			}

        $name = $row['dName'];
        $addStatement = "INSERT INTO room
              (dName, houseID, colourID, iconID) 
              VALUES ('Unallocated Sensors', '$houseID', '4', '35')";
        if (!$conn->query($addStatement)) {
          echo "Error: " . $addStatement . "<br>" . $conn->error;
        }
  
  }
  
  public static function updateProperty($userID, $defaultName, $userName, $propertyPassword, $propertyID)
  {
      require "../src/connect.php";
  
      $insertStatement = "UPDATE house
      SET house_password = '$propertyPassword', dName = '$defaultName'
      WHERE houseID = '$propertyID'";
  
      if (!$conn->query($insertStatement)) {
				echo "Error: " . $insertStatement . "<br>" . $conn->error;
			}
  
      $insertStatement = "UPDATE user_households
      SET houseName = '$userName'
      WHERE userID = '$userID' AND houseID = '$propertyID'";
  
      if (!$conn->query($insertStatement)) {
				echo "Error: " . $insertStatement . "<br>" . $conn->error;
			}
  }
}

?>
