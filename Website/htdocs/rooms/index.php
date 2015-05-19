<?php
	$title = "Rooms Overview";
	$path = "../src/templates/";
	include $path."main.php";
?>

<div class="col-lg-12" style="margin-left:15px">
	<a href="../roomsSettings" class="btn btn-danger btn-lg"><i class="fa fa-pencil"></i> Edit</a>
</div>

<?php if (login_check($conn) == true) : ?>

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
		<div class="col-lg-12 col-sm-12">
			<button class="btn btn-danger center-block btn-lg" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i></button>
		</div>
	</div>

	
	<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">Add Room</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form action="" method="post" id="addRoomForm">
							<label>Room Name:</label> <input type="text" id="Name" name="name" class="form-control"/>
							<br>
							<input type="button" value="Add Room" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
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

<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
