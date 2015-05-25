<?php
	$title = "Rooms Overview";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<?php 
		if (empty($_POST)===false)
		{
			
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
						<form class="form-horizontal" action="" method="post" id="addRoomForm">
							<div class="form-group">
								<label for="Name" class="col-sm-3 control-label">Room Name</label>
								<div class="col-sm-9">
									<input type="text" id="Name" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="colour" class="col-sm-3 control-label">Colour</label>
								<div class="col-sm-9">
									<select class="form-control" name="colour">
										<?php getRoomColours(); ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="icon" class="col-sm-3 control-label">Icon</label>
								<div class="col-sm-9">
									<select class="form-control" name="icon">
										<?php getIcons(); ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="show" class="col-sm-3 control-label">Show On Dashboard</label>
								<div class="col-sm-9">
									<input name="show" type="checkbox" value="">
								</div>									
							</div>
							<input type="button" value="Add Room" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="reset" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">					
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						
					<h2 class="modal-title" id="myModalLabel">Edit Room</h2>
					<button name="delete" class="btn btn-lg btn-danger btn-block" onclick="deleteRoom()"> Delete </button>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form class="form-horizontal" action="" method="post" id="editRoomForm" name="editRoomForm">
							<div class="form-group">
								<label for="roomID" class="col-sm-3 control-label">Room ID</label>
								<div class="col-sm-9">
									<input type="text" id="roomID" name="roomID" class="form-control" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input type="text" id="name" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label for="room" class="col-sm-3 control-label">Colour</label>
								<div class="col-sm-9">
									<select id="colour" name="colour" class="form-control">
										<?php 
											getRoomColours();
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="icon" class="col-sm-3 control-label">Icon</label>
								<div class="col-sm-9">
									<select id="icon" name="icon" class="form-control">
										<?php 
											getIcons();
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="show" class="col-sm-3 control-label">Show On Dashboard</label>
								<div class="col-sm-9">
									<input id="show" name="show" type="checkbox" value="">
								</div>									
							</div>							
							<input type="button" value="Edit Sensor" class="btn btn-lg btn-danger btn-block" onclick="editSensor()" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		
		function deleteRoom()
		{
			var ID = document.getElementById("roomID").value;
			
			$.post("deleteRoom.php", { func: "delete", id: ID })
			.done(function( data ) {
				location.reload();
			});
		};
		function submitForm()
		{
			$.post('addRoom.php', $('#addRoomForm').serialize())
			.done(function( data ) {
				location.reload();
			});
		};
		function editSensor()
		{
			$.post('editRoom.php', $('#editRoomForm').serialize())
			.done(function( data ) {
				location.reload();
			});
		};
		function openRoomForm(roomID, name, colourID, iconID, show)
		{
			document.forms["editRoomForm"]["roomID"].value = roomID;
			document.forms["editRoomForm"]["name"].value = name;
			document.forms["editRoomForm"]["colour"].selectedIndex = parseInt(colourID) - 1;
			document.forms["editRoomForm"]["icon"].selectedIndex =  parseInt(iconID) - 1;
			
			if (show == "0")
			{
				
			}
			else
			{
				document.forms["editRoomForm"]["show"].value =  "1";
				//document.forms["editRoomForm"]["show"].checked =  false;
			}
			
			$('#editRoomModal').modal('show');
		};
	</script>
		
	</script>
<?php } ?>
<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
