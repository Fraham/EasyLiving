<?php
	 $title = "Dashboard";
	 $path = "../src/templates/";
	 include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
<script src="getInfo.js"></script>
<script src="dashboard.js"></script>

<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12" id="roomsPanel">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-home fa-fw"></i> Overview
						</div>
						<div class="panel-body">
							<div id="overviewPanel"></div>
							<?php

								//include "getDoors.php";
							?>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12" id="roomsPanel" style="text-align:center;">
				<?php
					include "getDashboardRooms.php";
				?>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12" id="notifyPanel">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> Notifications Panel
			</div>
			<div class="panel-body">
				<div class="list-group" id="notificationPanel"></div>
				<a href="/notifications" class="btn btn-default btn-block">View All Alerts</a>
			</div>
		</div>
	</div>


</div>

<?php include $path."footer.php"; ?>

<?php else : ?>
<?php endif; ?>
