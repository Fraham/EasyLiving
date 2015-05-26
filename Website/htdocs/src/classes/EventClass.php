<?php

class Event
{
	public $eventID = "";
	public $name = "";
	public $userID = "";
	
	public $sensors = [];
	public $conditions = [];
	public $devices = [];	
	
	public static function getFromEventID($eventID)
	{
		require "../src/connect.php";
	  
	  	$event = new Event;
		  
		$statement = "SELECT event.name, event.userID
					FROM event
					WHERE event.eventID = $eventID";
	  
		$result = $conn->query($statement);
		
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$event->name = $row['name'];
			$event->userID = $row['userID'];
			$event->eventID = $eventID;
			
			$statement = "SELECT event_sensor.sensorID, event_sensor.conditionID
					FROM event_sensor
					WHERE event_sensor.eventID = $eventID";
	  
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					$event->sensors[] = $row['sensorID'];
					$event->conditions[] = $row['conditionID'];
			  	}			
			}
			
			/*$statement = "SELECT event_condition.conditionID
					FROM event_condition
					WHERE event_condition.eventID = $eventID";
	  
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					$event->conditions[] = $row['conditionID'];
			  	}			
			}*/
			
			$statement = "SELECT event_device.deviceID
					FROM event_device
					WHERE event_device.eventID = $eventID";
	  
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					$event->devices[] = $row['deviceID'];
			  	}			
			}
		}
		
		return $event;
	}
	
	public static function getByUserID($userID)
	{
		require "../src/connect.php";
		
		$events = [];
		
		$statement = "SELECT event.eventID
					FROM event
					WHERE event.userID = $userID";
	  
		$result = $conn->query($statement);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
		  	{
				  $events[] = Event::getFromEventID($row['eventID']);
			}		  
		}
		
		return $events;
	}
	
	public function getEventFormat()
	{
		$this->getSensorConditions();
		
		$html = $this->printSensorConditions();
		
		$eventHTML = <<<HTML
		<div class="col-lg-12">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
					{$this->name}
				</div>
				<div class="panel-body"id="settingsBody">
					{$html}
					<button class = "btn btn-danger btn-lg" onClick="changeID({$this->eventID})">Add sensor</button>
				</div>
			</div>
		</div>
HTML;
		
		
		echo $eventHTML;
	}
	
	public function getSensorConditions()
	{
		require "../src/connect.php";
		
		$events = [];
		
		$statement = "SELECT event_sensor.sensorID, event_sensor.conditionID
					FROM event_sensor
					WHERE event_sensor.sensorID = $this->eventID";
	  
		$result = $conn->query($statement);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
		  	{
				  $this->sensors[] = $row['sensorID'];
				  $this->conditions[] = $row['conditionID'];
			}		  
		}
	}
	
	public function printSensorConditions()
	{
		require "../src/connect.php";
		
		$html = "
		 <table class='table'>
		 <thread>
		  <tr>
		    <td>Sensor</td>
		    <td>Condition</td>
		  </tr>
		</thread>
		<tbody>";
			$statement = "SELECT sensors.name AS sensorName, `condition`.name AS conditionName
						FROM sensors
						INNER JOIN event_sensor
						ON sensors.sensorID = event_sensor.sensorID
						INNER JOIN `condition`
						ON `condition`.conditionID = event_sensor.conditionID
						WHERE event_sensor.eventID = '{$this->eventID}'";
			
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					 $html .= "<tr>
		    			<td>{$row['sensorName']}</td>
						<td>{$row['conditionName']}</td>
								</tr>";
						
						
						/*$condition = $this->conditions[$count];
						
					  $statement = "SELECT `condition`.name
						FROM `condition`
						WHERE `condition`.conditionID = '$condition'";
			
					$result = $conn->query($statement);
					
					if ($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc())
					  	{
							  $html .= "
		    					<td>{$row['name']}</td>
								</tr>";
						}
					}*/
				}		  
			}
		
		$html .= "</tbody>
		</table>";
		
		return $html;
	}
	
	public static function addEvent($name, $user_ID)
	{
		require "../src/connect.php";

		$statement = "INSERT INTO event (name, userID) VALUES ('$name','$user_ID')";
		
		if (!$conn->query($statement)) {
			echo "Error: " . $statement . "<br>" . $conn->error;
		}
	}
}
?>