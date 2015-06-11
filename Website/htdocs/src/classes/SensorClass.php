<?php
	
class Sensor
{
	public $sensorID = "";
	public $name = "";
	public $messageOn = "";
	public $messageOff = "";
	public $roomID = "";
	public $state = "";
	
	public static function getByUserID($userID)
	{
		$statement = "SELECT sensors.sensorID, sensors.name, sensors.messageOn, sensors.messageOff, sensors.roomID, sensors.state
	                FROM sensors
					INNER JOIN room
					ON sensors.roomID = room.roomID
					INNER JOIN house
					On room.houseID = house.houseID
	                INNER JOIN user_households
	                ON house.houseID = user_households.houseID
	                WHERE user_households.userID = $userID";
					
		return Sensor::getFromQuery($statement);
	}
	
	public static function getByRoomID($roomID)
	{
	  	$statement = "SELECT sensors.sensorID, sensors.name, sensors.messageOn, sensors.messageOff, sensors.roomID, sensors.state
		  			FROM sensors
	                WHERE sensors.roomID = $roomID";
					
		return Sensor::getFromQuery($statement);
	}
	
	public static function getFromQuery($statement)
	{
		require "../src/connect.php";
	  
	  	$sensors = [];
	  
		$result = $conn->query($statement);
	
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				if (substr( $row['sensorID'], 0, 2) === "01")// motion sensor
				{
					$sensor = new MotionSensor;
				}
				else if (substr( $row['sensorID'], 0, 2) === "02")// door sensor
				{
					$sensor = new DoorSensor;
				}
				else if (substr( $row['sensorID'], 0, 2) === "05")// relay sensor
				{
					$sensor = new RelaySensor;
				}
				else
				{
					$sensor = new Sensor;
				}
				
				$sensor->sensorID = $row['sensorID'];
				$sensor->name		= $row['name'];
				$sensor->messageOn	= $row['messageOn'];
				$sensor->messageOff   = $row['messageOff'];
				$sensor->roomID	= $row['roomID'];
				$sensor->state	= $row['state'];
				
				$sensors[] = $sensor;
		  }
		}
		
		  return $sensors;
	}
	
	public function getBlockFormat()
	{
		$sensorBlock = "";
		
		return $sensorBlock;
	}
	
	public static function updateSensor($sensorID, $name, $messageOn, $messageOff, $roomID)
	{
		require "../src/connect.php";
  
      	$insertStatement = "UPDATE sensors
      	SET name = '$name', messageOn = '$messageOn' , messageOff = '$messageOff', roomID = '$roomID'
      	WHERE sensorID = '$sensorID'";
  
      	if (!$conn->query($insertStatement)) {
			echo "Error: " . $insertStatement . "<br>" . $conn->error;
		}
	}
	
	public static function checkSensor($sensorID)
	{
		require "../src/connect.php";
		
		$statement = "SELECT assigned
					FROM sensors
					WHERE sensorID = '$sensorID'";
					
		$result = $conn->query($statement);
	
		if ($result->num_rows > 0)
		{
		  $row = $result->fetch_assoc();
		  
		  if (strcmp($row['assigned'], "0") === 0)
		  {
			  echo "sensor is free";
		  }
		  else if (strcmp($row['assigned'], "1") === 0)
		  {
			  echo "sensor is blocked";
		  }
		  else if (strcmp($row['assigned'], "2") === 0)
		  {
			  echo "sensor is locked";
		  }		  
		}
		else
		{
			echo "unknown sensor";
		}
	}
	
	public static function blockSensor($sensorID)
	{
		require "../src/connect.php";
		
		$statement = "SELECT assigned
					FROM sensors
					WHERE sensorID = '$sensorID'";
					
		$result = $conn->query($statement);
	
		if ($result->num_rows > 0)
		{
		  $row = $result->fetch_assoc();
		  
		  if (strcmp($row['assigned'], "0") === 0)
		  {
			  $insertStatement = "UPDATE sensors
      			SET assigned = '1'
      			WHERE sensorID = '$sensorID'";
  
		      if (!$conn->query($insertStatement)) 
			  {
				echo "Error: " . $insertStatement . "<br>" . $conn->error;
			  }
			  else
			  {
				echo "blocked";
			  }			
		  }
		  else
		  {
			  echo "not able to blocked";
		  }
		}
		else
		{
			echo "unknown sensor";
		}
	} 
	
	public static function addSensor($sensorID, $name, $messageOn, $messageOff, $roomID)
	{
		require "../src/connect.php";
  
      	$insertStatement = "UPDATE sensors
      	SET name = '$name', messageOn = '$messageOn' , messageOff = '$messageOff', roomID = '$roomID', state = '0'
      	WHERE sensorID = '$sensorID'";
  
      	if (!$conn->query($insertStatement)) {
			echo "Error: " . $insertStatement . "<br>" . $conn->error;
		}
		else
		{
			echo "assigned";
		}
	}
	
	public static function resetSensor($sensorID)
	{
		require "../src/connect.php";
		
		$insertStatement = "UPDATE sensors
      			SET assigned = '0'
      			WHERE sensorID = '$sensorID'";
  
		if (!$conn->query($insertStatement)) 
		{
			echo "Error: " . $insertStatement . "<br>" . $conn->error;
		}
	}
	
	
	public static function getTempByRoomID($roomID)
	{
		$statement = "SELECT sensors.sensorID, sensors.name, sensors.messageOn, sensors.messageOff, sensors.roomID, sensors.state
		  			FROM sensors
	                WHERE sensors.roomID = $roomID";
					
		return Sensor::getFromQuery($statement);
	}
	
	public static function getTempFormat($roomID)
	{
		require "../src/connect.php";
		$html = "";
		$statement = "SELECT temp, hum
					FROM temphum
					INNER JOIN sensors
					ON sensors.sensorID = temphum.sensorID
					WHERE sensors.roomID = '$roomID'
					ORDER BY id DESC
					LIMIT 1";
					
		$result = $conn->query($statement);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$html .="
				<div class='col-md-6'>
						<h4><font color='black'>Temperature: </font><span><strong>{$row['temp']}&deg;C</strong></span></h4>
					</div>
				<div class='col-md-6'>
						<h4><font color='black'>Humidity: </font><span><strong>{$row['hum']}%</strong></span></h4>
					</div>";
			}
		}
		
		return $html;
	}
}

class MotionSensor extends Sensor
{
	public function getBlockFormat()
	{
		$sensorBlock = "";
		
		return $sensorBlock;
	}
}

class DoorSensor extends Sensor
{
	public function getBlockFormat()
	{
		$sensorBlock = "";
		
		$message = "";
			
		if(strcmp($this->state, "0") === 0)
		{
			$message = $this->messageOff;
		}
		else
		{
			$message = $this->messageOn;
		}
			
		$sensorBlock = <<<HTML
			<div class='col-md-6'>
				<h4><font color='black'>{$this->name}: </font><span><strong>{$message}</strong></span></h4>
			</div>
HTML;
		
		return $sensorBlock;
	}
}

class RelaySensor extends Sensor
{
	public function getBlockFormat()
	{
		$sensorBlock = "";
		
		$sensorBlock = <<<HTML
		<div class='col-md-12'>
			<h4><font color='black'>{$this->name}: </font></h4>
			<div class='col-md-6'>
				<input type="button" value="On" class="btn btn-sm btn-danger btn-block" onclick="turnOn('{$this->sensorID}')" />
			</div>
			<div class='col-md-6'>
				<input type="button" value="Off" class="btn btn-sm btn-danger btn-block" onclick="turnOff('{$this->sensorID}')" />
			</div>
		</div>
HTML;
		
		return $sensorBlock;
	}
}


?>