<?php 
	class Log
	{
		public $logID = "";
		public $sensorID = "";
		public $state = "";
		public $date = "";

		public static function getByEventID($logID)
		{
			require "../src/connect.php";
	  
		  	$log = new Log;
			  
			$logStatement = "SELECT log.sensorID, log.state, DATE_FORMAT(log.date,'%d %M %Y %T') as time
						FROM log
						WHERE log.logID = '$logID'";
		  
			$logResult = $conn->query($logStatement);
		
			if ($logResult->num_rows > 0)
			{
				while($logRow = $logResult->fetch_assoc())
				{
					$log->logID = $logID;
					$log->sensorID = $logRow['sensorID'];
					$log->state	= $logRow['state'];
					$log->date = $logRow['time'];
				}
			}
			
			return $log;
		}
	}
?>