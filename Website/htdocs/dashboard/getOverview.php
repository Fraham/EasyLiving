<?php
	$doorHTML = "";
	require_once "../src/connect.php";
    require_once "../src/classes/PropertyClass.php";
    
    include "../src/includes/functions.php";

	sec_session_start();

    $userID = $_SESSION['user_id'];
    
    $properties = [];
    
    $properties = Property::getByUserID($userID);
    
    $propertyData = array();
    
    foreach($properties as $property)
    {
        $statement = "SELECT state, sensorID, name, room.dName
                FROM sensors
                INNER JOIN room
                ON sensors.roomID = room.roomID
                INNER JOIN house
                ON room.houseID = house.houseID
                WHERE house.houseID = {$property->houseID}
                AND state = 1";

        $result = $conn->query($statement);
    
        $motion = 0;
    
    	if ($result->num_rows > 0)
    	{
            $sensorData = array();
            
    		while($row = $result->fetch_assoc())
            {
                if (0 === strpos($row['sensorID'], '02'))
                {                    
                    $sensorData[] = array("sensor" => $row['name'], "room" => $row['dName']);
                }
                elseif (0 === strpos($row['sensorID'], '01'))
                {
                    if ($row['state'] == 1)
                    {
                        $motion = 1;
                    }
                }
    
    		}
    	}
        else
        {
            $doorHTML .= "";
        }
        
        $occupied = ($motion == 1 ? "Yes" : "No");
        
        $data = array("propertyName" => $property->userName, "occupied" => $occupied, "sensorData" => $sensorData);
        
        $propertyData[] = $data;
        
        $sensorData = array();        
    }
    
    $jsonResult['message'] = "no";
    $jsonResult['data'] = $propertyData;		
	
	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);
?>
