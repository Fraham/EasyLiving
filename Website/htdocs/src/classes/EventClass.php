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
		$eventHTML = <<<HTML
		<div class="col-lg-12">
			<div class="panel panel-default">
				<a><div class="panel-heading" ></a>
				{$this->name}
				</div>
				<div class="panel-body"id="settingsBody">
					<button class = "btn btn-danger btn-lg" style="margin-top:0px">Add sensor</button>
					<br>
					<button class = "btn btn-danger btn-lg" style="margin-top:10px">Add condition</button>
					<br>
					<button class = "btn btn-danger btn-lg" style="margin-top:10px">Add device to be activated</button>
				</div>
			</div>
		</div>
HTML;
		
		
		echo $eventHTML;
	}
}
?>