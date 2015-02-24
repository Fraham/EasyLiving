<?php
   $title = "Rooms Overview";
   $path = "../src/templates/";
   include $path."main.php";
?>	
	
	
	
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-comments fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Living Room</div>
						<div>Occupied</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h3><font color="black">Window:</font><span class="text-danger">Open</span></h3>
				</div>
				<div class="col-md-6">
					<h3>Lamp: **Bootstrap Switch**</h3>
					<label for="flip-a">Select slider:</label>
					<select name="slider" id="flip-a" data-role="slider">
						<option value="off">Off</option>
						<option value="on">On</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<!--Modal-->

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-cutlery fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Kitchen</div>
						<div>Unoccupied</div>
					</div>
				</div>
			</div>

			<div class="panel-body">
				<div class="col-md-6">
					<h3>Window: <span class="text-danger">Open</span></h3>
					<h3>Fridge: <span class="text-success">Closed</span></h3>

				</div>
				<div class="col-md-6">
					<h3>Lamp: **Bootstrap Switch**</h3>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Bedroom</div>
						<div>Unoccupied</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h3>Window: <span class="text-danger">Open</span></h3>
				</div>
				<div class="col-md-6">
					<h3>Lamp: **Bootstrap Switch**</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-briefcase fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Office</div>
						<div>Unoccupied</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h3>Window: <span class="text-danger">Open</span></h3>
				</div>
				<div class="col-md-6">
					<h3>Lamp: **Bootstrap Switch**</h3>
				</div>
			</div>
		</div>
	</div>

<?php include $path."footer.php"; ?>