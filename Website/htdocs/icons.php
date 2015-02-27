<?php
	$title = "Icons";
	$path = "src/templates/";
	include $path."main.php";
	require_once "src/connect.php";
	$iconSize = 50;
	$html = "<div class='col-lg-12' id='icons' style='width: 100%;'>";

	$statement = "SELECT I.iconID, I.icon
				  FROM icons as I";

	$result = $conn->query($statement);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$html .= "
				
					<div class='col-lg-1' style='width: ".$iconSize."px; margin: 10px; float: left;'>
						<i class='fa fa-".$row["icon"]." fa-4x' alt='".$row["iconID"]."'></i>
					</div>";
		}
	}
	$conn->close();
	$html .= "<div id='showID'></div></div>";
	echo $html;
	include $path."footer.php";
?>

<script>
	$("#icons i").click(function(e) {
		alert($(this).attr('alt'));
	});
</script>



