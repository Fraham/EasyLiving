<?php
	$roomHTML = "";
	require_once "../src/connect.php";

    $houseID = $_SESSION['house_id'];

	$statement = "SELECT state, sensorID, name FROM sensors
        INNER JOIN room
        ON sensors.roomID = room.roomID
        INNER JOIN house
        ON room.houseID = house.houseID
        WHERE house.houseID = $houseID";

    $result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
        {
            if (0 === strpos($row['sensorID'], '02'))
            {
                if (strcmp($row['state'], "open") === 0)
                {
                    $roomHTML .= "<h4>";
                    $roomHTML .= "$row[name]";
                    $roomHTML .= ": <span class='text-danger'>Open</span></h4>";
                }
                else
                {
                    $roomHTML .= "<h4>";
                    $roomHTML .= "$row[name]";
                    $roomHTML .= ": <span class='text-success'>Closed</span></h4>";
                }
            }
		}
	}
    else
    {
        $roomHTML .= "no results";
    }

	echo $roomHTML;
?>
