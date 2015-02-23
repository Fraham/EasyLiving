<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Easy Living</title>

  <!-- jQuery -->
  <script src="../src/bower_components/jquery/dist/jquery.min.js"></script>

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
</head>

<body>
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
		<img alt="140x140" src="../src/images/logo.png" class="img-responsive center-block" style="width:25%;height:25%;">
      </div>
      <!-- /.navbar-header -->



      </div>
      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <div class="input-group custom-search-form col-lg-12 hidden-xs">
                <img alt="140x140" src="../src/images/logo.png" class="img-responsive" style="width:100%;height:100%;">
            </div>
            <!-- /input-group -->
            <li>
              <a href="index.html" style="color: #D80000"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
				<a href="#" style="color: #D80000"><i class="fa fa-sitemap fa-fw"></i> Rooms<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level dropdown-toggle">
                <li>
                  <a href="room.html" style="color: #D80000">Overview</a>
                </li>
                <li>
                  <a href="roomSettings.html" style="color: #D80000">Room Settings</a>
                </li>
				</ul>
            </li>
            <li>
              <a href="notifications.php" style="color: #D80000"><i class="fa fa-exclamation fa-fw"></i> Notifications</a>
            </li>
            <li>
				<a href="#"style="color: #D80000"><i class="fa fa-home fa-fw"></i> Household<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
                <li>
                  <a href="residents.html"style="color: #D80000">Residents</a>
                </li>
                <li>
                  <a href="selection.html"style="color: #D80000">Household Selection</a>
                </li>
				</ul>
            </li>
			<li>
				<a href="preferences.html" style="color: #D80000"><i class="fa fa-edit fa-fw"></i>Preferences</a>
			</li>
			<li>
				<a href="login.html" style="color: #D80000"><i class="fa fa-sign-out fa-fw"></i>Log out</a>
			</li>
          </div>
          <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
      </nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Notifications</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Notifications Tables
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <table class="table table-striped table-bordered table-hover" id="notifications">
                    <thead>
                      <tr>
                        <th>Room</th>
                        <th>Comment</th>
                        <th>Date and Time</th>
                        <th>Sensor Type</th>
                      </tr>
                    </thead>
                    <script>
                      refresh();

                      function refresh()
                      {
                        $.post("getNotificationTable.php", function( data ) {
                          $("#notifications").html( data );
                        });
                      }
                      var intervalID = setInterval(refresh, 500);
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /#wrapper -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
