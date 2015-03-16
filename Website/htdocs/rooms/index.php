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
<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
