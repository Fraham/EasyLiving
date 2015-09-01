<?php
	$title = "Room Settings";
	$pageName = "roomsSettings";
	$path = "../src/templates/";
	include $path."main.php";
?>
<?php if (login_check($conn) == true) : ?>

	<div id="roomsList" class="col-lg-12">
		<?php
		include("../notifications/getNotificationsGraph.php");
		getRoomsSettings();
		?>
		</div>
	  	</div>
	</div>

<script type="text/javascript">
	var orderInit = {};
	$('#roomsList').sortable({
		handle: '.drag-handle',
		animation: 150,
		store: {
			get: function (sortable) {
	            var order = sortable.toArray();
	            $.each(order, function(i, id){
	            	orderInit[id] = i;
	            	i++;
	            });
	            return []
	        },
	        set: function (sortable) {
	            var order = sortable.toArray();
	            console.log(order);
	            $.each(order, function(i, id){
	            	console.log(orderInit[id] + " -> " + i);
	            	i++;
	            });
	        }
        }
	});
</script>



<?php
	include $path."footer.php"
?>

<?php else : ?>
<?php endif; ?>