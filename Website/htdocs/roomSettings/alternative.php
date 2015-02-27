<?php
	$title = "Room Settings";
	$path = "../src/templates/";
	include $path."main.php";
?>

<script>
	$(function() {
		$( "#draggableElem" ).sortable({
			connectWith: "#draggableElem",
			handle: "#handle",
			//cancel: ".portlet-toggle",
			//placeholder: "portlet-placeholder ui-corner-all"
		});
		$( "#draggableElem" ).disableSelection();
	});
</script>
	<div class="" id="draggableElem" >
		<div  id="draggableItem">
			<img src="<?php echo $path; ?>../images/dragHandle.png" id="handle">
			one
		</div>	
		<div  id="draggableItem">
			<img src="<?php echo $path; ?>../images/dragHandle.png" id="handle">
			two
		</div>	
		<div  id="draggableItem">
			<img src="<?php echo $path; ?>../images/dragHandle.png" id="handle">
			three
		</div>
	</div>	


<?php
	include $path."footer.php"
?>
