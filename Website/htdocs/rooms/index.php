<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Easy Living Rooms Overview</title>
  <link rel="shortcut icon" href="../src/images/TabLogo.png">
  <!-- Bootstrap Core CSS -->
  <link href="../src/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="../src/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

  <!-- Timeline CSS -->
  <link href="../src/dist/css/timeline.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../src/dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="../src/bower_components/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../src/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->
<nav class=" navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header centered">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class ="clearfix"></div>
				<img src="images/logo.png" class="hidden-lg hidden-sm hidden-md img-responsive" style="width:35%;height:35%; margin:auto; padding:0px">
			</div>
			<ul class="nav navbar-top-links navbar-right pull-right">
				<li class="dropdown">
					<a class="dropdown-toggle" style="color:#D80000" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<div style="text-align: center"><h4> Available Houses</h4></div>
						
						<li class="divider"></li>
						<p style = "text-align: center">******php to pull all households to available******</p>
						<li class="divider"></li>
						<li><a href="#"><i class="fa fa-plus fa-fw"></i> Add House</a></li>
						<li><a href="../login"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
                    <!-- /.dropdown-user -->
                </li>
			</ul>
		</nav>
	</div>
      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
				<div class="input-group custom-search-form col-lg-12 hidden-xs">
					<img src="../src/images/logo.png" class="img-responsive" style="width:100%;height:100%;">
				</div>
				<?php require_once "getMenu.php"?>
			</ul>
        </div>
      </div>

	
	
	
	
	
	
	
	
	
	
	
	
	
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Rooms Overview</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
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
      </div>

    </div>
    <!-- /#page-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="../src/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="../src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="../src/bower_components/metisMenu/dist/metisMenu.min.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="../src/dist/js/sb-admin-2.js"></script>

</body>

</html>
