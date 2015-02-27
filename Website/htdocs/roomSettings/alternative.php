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
			<button class="btn btn-default" data-toggle="modal" data-target="#iconModal"></button>
		</div>
	</div>

	<div class="modal fade" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">select an icon</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<?php
						require_once "../src/connect.php";
						$iconSize = 100;
						$html = "<div class='col-lg-12' id='icons' style='width: 100%;'>";

						$statement = "SELECT I.iconID, I.icon
									  FROM icons as I";

						$result = $conn->query($statement);

						if ($result->num_rows > 0)
						{
							while($row = $result->fetch_assoc())
							{
								$html .= "
									
										<div class='col-lg-1' style=' margin: auto; border-width: 5px; border-style:solid;' >
											<!--<button class='btn btn-default' style=''>-->
												<i class='fa fa-".$row["icon"]." fa-3x' alt='".$row["iconID"]."' style='width: ".$iconSize."px;'></i>
											<!--</button>-->
										</div>";
							}
						}
						$conn->close();
						echo $html;


						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	html
<?php
	include $path."footer.php"
?>