<?php
	$tableHtml = "";
	require_once "../src/connect.php";

	include "../src/includes/functions.php";
	
	$where = "";
	$set = 0;
	
	if (isset($_GET["propertyID"]))
	{
	  $propertyID = $_GET["propertyID"];
	  
	  if (strcmp($propertyID, 'Any') !== 0)
	  {			  
		  if ($set == 0)
		  {
		    $where .= "WHERE ";
		  }
		  else
		  {
		    $where .= " AND  ";
		  }
		
		  $where .= "house.houseID = ";
		  $where .= $propertyID;
		
		  $set = 1;
	  }
	}
	
	if (isset($_GET["roomID"]))
	{
	  $roomID = $_GET["roomID"];
	  
	  if (strcmp($roomID, 'Any') !== 0)
	  {		
		  if ($set == 0)
		  {
		    $where .= "WHERE ";
		  }
		  else
		  {
		    $where .= " AND  ";
		  }
		
		  $where .= "room.roomID = ";
		  $where .= $roomID;
		
		  $set = 1;
	  }
	}
	
	if (isset($_GET["sensorID"]))
	{
	  $sensorID = $_GET["sensorID"];
	  
	  if (strcmp($sensorID, 'Any') !== 0)
	  {		
		  if ($set == 0)
		  {
		    $where .= "WHERE ";
		  }
		  else
		  {
		    $where .= " AND  ";
		  }
		
		  $where .= "sensors.sensorID = ";
		  $where .= $sensorID;
		
		  $set = 1;
	  }
	}
	
	/*if (isset($_GET["startDate"]))
	{
	  $startDate = $_GET["startDate"];
	
	  if ($set == 0)
	  {
	    $where .= "WHERE";
	  }
	  else
	  {
	    $where .= "AND ";
	  }
	
	  $where .= "log.date = ";
	  $where .= $propertyID;
	
	  $set = 1;
	}
	
	if (isset($_GET["endDate"]))
	{
	  $endDate = $_GET["endDate"];
	
	  if ($set == 0)
	  {
	    $where .= "WHERE";
	  }
	  else
	  {
	    $where .= "AND ";
	  }
	
	  $where .= "house.houseID = ";
	  $where .= $propertyID;
	
	  $set = 1;
	}*/

	/*sec_session_start();

	$houseID = $_SESSION['house_id'];*/

	$statement = "SELECT room.dName, DATE_FORMAT(log.date,'%d %M %Y %T') as time, sensors.name  as sensorName, sensors.messageOn, sensors.messageOff, log.state
		FROM log
		INNER JOIN sensors
		ON log.sensorID = sensors.sensorID
		INNER JOIN room
		ON sensors.roomID = room.roomID
		INNER JOIN house
		ON room.houseID = house.houseID ";
	$statement .= $where;
	$statement .= " ORDER BY logID DESC LIMIT 20";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		$tableHtml .=
		"<thead>
			<tr>
				<th>Room</th>
				<th>Sensor Name</th>
				<th>Message</th>
				<th>Date and Time</th>
			</tr>
		</thead>";

		while($row = $result->fetch_assoc())
		{
			$state = (int) $row["state"];
			$message = "";

			if($state == 0)
			{
				$message = $row['messageOff'];
			}
			else
			{
				$message = $row['messageOn'];
			}

			$tableHtml .= "<tbody>";
			$tableHtml .= "<tr>";
			$tableHtml .= "<td class='center'> $row[dName] </td>";
			$tableHtml .= "<td class='center'> $row[sensorName] </td>";
			$tableHtml .= "<td class='center'> $message </td>";
			$tableHtml .= "<td class='center'> $row[time] </td>";
			$tableHtml .= "</tr>";
			$tableHtml .= "</tbody>";
		}
	}
	else
	{
		$tableHtml .= "There is nothing to dislay.";
	}

	$conn->close();

	echo $tableHtml;
?>
