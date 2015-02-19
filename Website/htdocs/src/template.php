<!DOCTYPE html>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="images/TabLogo.png">
	<!-- jQuery -->
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap Core CSS -->
	<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="dist/css/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="bower_components/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core JavaScript -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="dist/js/sb-admin-2.js"></script>
	
	<div id="wrapper">
		<!-- Navigation -->
		<nav class="hidden-lg hidden-sm hidden-md navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header centered">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class ="clearfix"></div>
				<img src="images/logo.png" class="img-responsive" style="width:35%;height:35%; margin:auto; padding:0px">
			</div>
		</nav>
	</div>
      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
				<div class="input-group custom-search-form col-lg-12 hidden-xs">
					<img src="images/logo.png" class="img-responsive" style="width:100%;height:100%;">
				</div>
				<?php include "getMenu.php"?>
			</ul>
        </div>
      </div>
	

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bell fa-fw"></i> House Overview
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
					<h4>Front Door: <span class="text-success">Closed</span></h4>
					<h4>Back Door: <span class="text-success">Closed</span></h4>
					<h4>House Occupied: <span class="text-warning">Yes</span></h4>

					</div>
            <!-- /.panel-body -->
				</div>

			</div>
          <!-- /#page-wrapper -->
        <div class="col-lg-6">
			<div class="col-lg-6 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-comments fa-4x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">Living Room</div>
								<div>Occupied</div>
							</div>
						</div>
					</div>

                <div class="panel-body">
					<div class="col-md-6">
						<h4><font color="black">Window: </font><span class="text-danger">Open</span></h4>
					</div>
					<div class="col-md-6">
						<h4>Lamp: **Switch**</h4>
						<select name="slider" id="flip-a" data-role="slider">
						<option value="off">Off</option>
						<option value="on">On</option>
						</select>
					</div>
				</div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-cutlery fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">Kitchen</div>
                  <div>Unoccupied</div>
                </div>
              </div>
            </div>

            <div class="panel-body">
				<div class="col-md-6">
					<h4>Window: <span class="text-danger">Open</span></h4>
					<h4>Fridge: <span class="text-success">Closed</span></h4>

					</div>
					<div class="col-md-6">
						<h4>Lamp: **Switch**</h4>
						<select name="slider" id="flip-a" data-role="slider">
						<option value="off">Off</option>
						<option value="on">On</option>
						</select>
					</div>
                    <div class="clearfix"></div>
              </div>
          </div>
        </div>
		
		<div class="clearfix visible-md-block visible-lg-block"></div>

        <div class="col-lg-6 col-md-6">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">Bedroom</div>
                  <div>Unoccupied</div>
                </div>
              </div>
            </div>

              <div class="panel-body">
					<div class="col-md-6">
						<h4>Window: <span class="text-danger">Open</span></h4>
					</div>
					<div class="col-md-6">
						<h4>Lamp: **Bootstrap Switch**</h4>
					</div>
              </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-briefcase fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">Office</div>
                  <div>Unoccupied</div>
                </div>
              </div>
            </div>
              <div class="panel-body">
					<div class="col-md-6">
						<h4>Window: <span class="text-danger">Open</span></h4>
					</div>
					<div class="col-md-6">
						<h4>Lamp: **Bootstrap Switch**</h4>
					</div>
              </div>
          </div>
        </div>
		<div class="clearfix visible-md-block"></div>

	 </div>
	<div class="col-lg-3 col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> Notifications Panel
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="list-group" id="notificationPanel">
					<script>
						refresh();
						function refresh()
						{
							$.post( "getNotificationPanel.php", function( data ) {
							  $( "#notificationPanel" ).html( data );
							});
						}
						var intervalID = setInterval(refresh, 500);
					</script>
				</div>
				<!-- /.list-group -->
				<a href="notifications.php" class="btn btn-default btn-block">View All Alerts</a>
			</div>
			<!-- /.panel-body -->
		</div>

	</div>
          <!-- /#page-wrapper -->


	</div>
	</div>





      </head>

      </html>
