<?php
	$title = "Rooms Overview";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<div class="col-lg-12" id = "roomsPanel" style="width: 100%;">

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
<div class="col-lg-12">
<a href="#" class="btn btn-danger btn-lg"><i class="fa fa-pencil"></i></a>
</div>
<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
