<?php
	$title = "Rooms Overview";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<?php 
		if (empty($_POST)===false)
		{
			$dName = $_POST['name'];
			$houseID = $_SESSION['house_id'];
			$colourID = $_POST['colour'];
			$iconID = $_POST['icon'];
			require "../src/connect.php";

			$houseID = $_SESSION['house_id'];

			$statement = "INSERT INTO room 
						(dName, houseID, colourID, iconID) 
						VALUES ('$dName', '$houseID', '$colourID', '$iconID')";
			if (!$conn->query($statement)) {
				echo "Error: " . $statement . "<br>" . $conn->error;
			}
			$conn->close();
		}else{
	?>
	

		
<div class="col-lg-12" id = "roomsPanel" style="width: 100%; margin-top: 20px;">

	<?php
		// $blockSize = 500;
		include "../src/func/getRooms.php";
	?>
	<script>
		$(function() {
			$( "#roomsPanel" ).sortable({
				//revert: true
			});
		});
	</script>
</div>
	<div class="row">
		<?php
			include("../notifications/getNotificationsGraph.php");	
		?>
	</div>
		
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<button class="btn btn-danger center-block btn-lg" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i></button>
		</div>
	</div>

	
	<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title" id="myModalLabel">Add Room</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form action="" method="post" id="addRoomForm">
							<label>Room Name:</label> <input type="text" id="Name" name="name" class="form-control"/>
							<br>
							<label>Colour</label>
							<select class="form-control" name="colour">
								<?php getRoomColours(); ?>
							</select>
							<br>
							<label>Icon</label>
							<select class="form-control" name="icon">
								<?php getIcons(); ?>
							</select>
							<br>
							<input type="button" value="Add Room" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="reset" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		
		function deleteRoom(ID)
		{
			$.post("deleteRoom.php", { func: "delete", id: ID })
			.done(function( data ) {
				location.reload();
			});
		};
		function submitForm()
		{
			$.post('index.php', $('#addRoomForm').serialize())
			.done(function( data ) {
				location.reload();
			});
		};
		
		
	</script>
<?php } ?>
<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
