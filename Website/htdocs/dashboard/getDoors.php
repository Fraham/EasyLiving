<?php
	$doorHTML = "";
	require_once "../src/connect.php";
    require_once "../src/classes/PropertyClass.php";

    $userID = $_SESSION['user_id'];
    
    $properties = [];
    
    $properties = Property::getByUserID($userID);
    
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
            $doorHTMLtemp = "";
    		while($row = $result->fetch_assoc())
            {
                if (0 === strpos($row['sensorID'], '02'))
                {
                    $doorHTMLtemp .= "<div style='text-indent: 2em;'>";
    				$doorHTMLtemp .= "<h4>";
    				$doorHTMLtemp .= "$row[name]";
                    $doorHTMLtemp .= " ({$row['dName']}): ";
    				$doorHTMLtemp .= "<span class='text-danger'>Open</span></h4>";
                    $doorHTMLtemp .= "</div>";
                    
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
    
        if ($motion == 1)
        {
            $doorHTML .= "<h4>{$property->userName} Occupied: <span>Yes</span></h4>";
        }
        else
        {
            $doorHTML .= "<h4>{$property->userName} Occupied: <span>No</span></h4>";
        }
        
        $doorHTML .= $doorHTMLtemp;
        $doorHTMLtemp = "";
    }

	echo $doorHTML;
?>
