<?php
	$doorHTML = "";
	require_once "../src/connect.php";

  $houseID = $_SESSION['house_id'];

	$statement = "SELECT state, sensorID, name FROM sensors
        INNER JOIN room
        ON sensors.roomID = room.roomID
        INNER JOIN house
        ON room.houseID = house.houseID
        WHERE house.houseID = $houseID";

    $result = $conn->query($statement);

    $motion = 0;

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
        {
            if (0 === strpos($row['sensorID'], '02'))
            {
                if (strcmp($row['state'], "open") === 0)
                {
                    $doorHTML .= "<h4>";
                    $doorHTML .= "$row[name]";
                    $doorHTML .= ": <span class='text-danger'>Open</span></h4>";
                }
                else
                {
                    $doorHTML .= "<h4>";
                    $doorHTML .= "$row[name]";
                    $doorHTML .= ": <span class='text-success'>Closed</span></h4>";
                }
            }
            elseif (0 === strpos($row['sensorID'], '01'))
            {
                if (strcmp($row['state'], "detected") === 0)
                {
                    $motion = 1;
                }
            }
		}
	}
    else
    {
        $doorHTML .= "T";
    }

    if ($motion == 1)
    {
        $doorHTML .= "<h4>Property Occupied: <span>Yes</span></h4>";
    }
    else
    {
        $doorHTML .= "<h4>Property Occupied: <span>No</span></h4>";
    }

	echo $doorHTML;
?>
