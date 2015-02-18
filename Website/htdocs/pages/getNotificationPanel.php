<?php	
	$tableHtml = "";
	require "../connect.php";
	
	//$sql = "SELECT DATE_FORMAT(time,'%k:%i:%s') as time, data FROM test ORDER BY idtest DESC LIMIT 15";
	$sql = "SELECT data FROM test ORDER BY idtest DESC LIMIT 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) {
			$tableHtml .= "<a href='#' class='list-group-item'><i class='fa fa-comment fa-fw'></i>";
			$tableHtml .= $row[time];
			$tableHtml .= "<span class='pull-right text-muted small'><em>4 minutes ago</em></span>";
		}
	}
	$conn->close();
	echo $tableHtml;
?>