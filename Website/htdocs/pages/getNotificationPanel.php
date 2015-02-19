<?php
	$tableHtml = "";
	require_once "../connect.php";

	$sql = "SELECT DATE_FORMAT(time,'%k:%i:%s') as time, data FROM test ORDER BY idtest DESC LIMIT 10";
	//$sql = "SELECT data FROM test ORDER BY idtest DESC LIMIT 10";

	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()) {
			$tableHtml .= "<a href='#' class='list-group-item'>";//<i class='fa fa-comment fa-fw'></i>";
			$tableHtml .= "$row[data]";
			$tableHtml .= "<span class='pull-right text-muted small'><em>";
			$tableHtml .= "$row[time]";
			$tableHtml .= "</em></span>";
		}
	}
	$conn->close();
	echo $tableHtml;
?>

<!--					fa fa-comment fa-fw
						fa fa-twitter fa-fw
						fa fa-envelope fa-fw
						fa fa-tasks fa-fw
						fa fa-upload fa-fw
						fa fa-bolt fa-fw
						fa fa-warning fa-fw
						fa fa-shopping-cart fa-fw
						fa fa-money fa-fw-->
