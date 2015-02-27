<?php
	$title = "Rooms Overview";
	$path = "../src/templates/";
	include $path."main.php";
?>


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

<?php include $path."footer.php"; ?>
