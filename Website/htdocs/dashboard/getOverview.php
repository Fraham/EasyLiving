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
            //$doorHTMLtemp = "";

            $sensorData = array();
            
    		while($row = $result->fetch_assoc())
            {
                if (0 === strpos($row['sensorID'], '02'))
                {
                    /*$doorHTMLtemp .= "<div style='text-indent: 2em;'>";
    				$doorHTMLtemp .= "<h4>";
    				$doorHTMLtemp .= "$row[name]";
                    $doorHTMLtemp .= " ({$row['dName']}): ";
    				$doorHTMLtemp .= "<span class='text-danger'>Open</span></h4>";
                    $doorHTMLtemp .= "</div>";*/
                    
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
    
        /*if ($motion == 1)
        {
            $doorHTML .= "<h4>{} Occupied: <span>Yes</span></h4>";
        }
        else
        {
            $doorHTML .= "<h4>{$property->userName} Occupied: <span>No</span></h4>";
        }*/
        
        //$doorHTML .= $doorHTMLtemp;
        //$doorHTMLtemp = "";
        $sensorData = array();        
    }
    
    $jsonResult['messgae'] = "no";
    $jsonResult['data'] = $propertyData;		
	
	echo json_encode($jsonResult, JSON_NUMERIC_CHECK);

	echo $doorHTML;
?>
