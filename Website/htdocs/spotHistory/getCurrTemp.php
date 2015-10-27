<?php

function getTemp($spotID){
	
require_once "../src/connect.php";

$temp = "n/a";

$statement = "SELECT T.temperature FROM temperaturelog as T
			ORDER BY date ASC
			WHERE spotID = $spotID
" ;

$result = $conn->query($statement);

if ($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	
	$temp = $row[temperature];
}

$conn->close();
echo $temp;
}
?>