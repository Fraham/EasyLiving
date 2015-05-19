<?php

class Event
{
	public $eventID = "";
	public $name = "";
	
	public $sensors = [];
	public $conditions = [];
	public $devices = [];	
	
	public static function getFromEventID($eventID)
	{
		require "../src/connect.php";
	  
	  	$event = new Event;
		  
		$statement = "SELECT event.name
					FROM event
					WHERE event.eventID = $eventID";
	  
		$result = $conn->query($statement);
		
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$event->name = $row['name'];
			
			$statement = "SELECT event_sensor.sensorID
					FROM event_sensor
					WHERE event_sensor.eventID = $eventID";
	  
			$result = $conn->query($statement);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
			  	{
					$event->$sensors[] = $row['sensorID'];
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
					$event->$conditions[] = $row['conditionID'];
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
					$event->$devices[] = $row['deviceID'];
			  	}			
			}
		}
		
		return $event;
	}
}
?>