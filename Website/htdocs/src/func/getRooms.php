<?php
require_once "../src/connect.php";
$roomHTML = "";

if (!isset($blockSize))
	$blockSize = 370;

if (isset($_SESSION['house_id']))
{

$houseID = $_SESSION['house_id'];

$statement = "SELECT R.dName, RC.occupied, RC.unoccupied, I.icon
			  FROM room as R
			  INNER JOIN room_colour as RC
			  ON R.colourID = RC.colourID
			  INNER JOIN icons as I
			  ON R.iconID = I.iconID
			  WHERE	R.houseID = $houseID";

$result = $conn->query($statement);


if ($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		if (true) //motion sensor state
			$color = $row["occupied"];
		else
			$color = $row["unoccupied"];


		$roomHTML .= "
			<div class='col-lg-2 room-xs' style='width: ".$blockSize."px; margin: auto; float: none;display: inline-block;'>
				<div class='panel panel-".$color."'>
					<div class='panel-heading'>
						<div class='row'>
							<div class='col-xs-3'>
								<i class='fa fa-".$row["icon"]." fa-4x'></i>
							</div>
							<div class='col-xs-9 text-right'>
								<div class='huge'>".$row["dName"]."</div>
								<div>Occupied</div>
							</div>
						</div>
					</div>
					<div class='panel-body'>
						<div class='col-md-6'>
							<h4><font color='black'>Window: </font><span class='text-danger'>Open</span></h4>
						</div>
						<div class='col-md-6'>
							<h4>Lamp:
								<span><div class='btn-group btn-toggle'>
									<button class='btn btn-xs btn-default'>ON</button>
									<button class='btn btn-xs btn-danger active'>OFF</button>
								</span>
							</h4>
						</div>
					</div>
				</div>
			</div>";
	}
}

$conn->close();
echo $roomHTML;
}
else
{
	echo "house id not set";
}
?>

<script>
	$('.btn-toggle').click(function() {
		$(this).find('.btn').toggleClass('active');

		if ($(this).find('.btn-danger').size()>0) {
			$(this).find('.btn').toggleClass('btn-danger');
		}
		$(this).find('.btn').toggleClass('btn-default');
	});

	$('form').submit(function(){
		alert($(this["options"]).val());
		return false;
	});
</script>
