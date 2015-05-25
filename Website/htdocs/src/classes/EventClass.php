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
			
			$statement = "SELECT event_sensor.sensorID
					FROM event_sensor
					WHERE event_sensor.eventID = $eventID";
	  
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					$event->sensors[] = $row['sensorID'];
			  	}			
			}
			
			$statement = "SELECT event_condition.conditionID
					FROM event_condition
					WHERE event_condition.eventID = $eventID";
	  
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					$event->conditions[] = $row['conditionID'];
			  	}			
			}
			
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
		 <table>
		  <tr>
		    <td>Sensor</td>
		    <td>Condidtion</td>
		  </tr>
		</table>";
		
		$count = 0;
		
		foreach($this->sensors as $sensor)
		{
			$statement = "SELECT name
						FROM sensors
						WHERE senors.sensorID = '$sensor'";
			
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					 $html .= "<tr>
		    			<td>{$row['name']}</td>";
						
					  $statement = "SELECT name
						FROM condition
						WHERE condition.conditionID = '$this->conditions[$count]'";
			
					$result = $conn->query($statement);
					
					if ($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc())
					  	{
							  $html .= "
		    					<td>{$row['name']}</td>
								</tr>";
						}
					}
				}		  
			}
			
			
			$count = $count + 1;
		}
		
		$html = "</table>";
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