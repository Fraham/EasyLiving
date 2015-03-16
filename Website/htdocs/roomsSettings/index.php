<?php
	$title = "Room Settings";
	$path = "../src/templates/";
	include $path."main.php";
?>
<?php if (login_check($conn) == true) : ?>

<div id='roomsList'>
			<div id='room'><span class="drag-handle">&#9776;</span>Living Room</div>
			<div id='room'><span class="drag-handle">&#9776;</span>Kitchen</div>
			<div id='room'><span class="drag-handle">&#9776;</span>Other Room</div>
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