<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Easy Living</title>
  <link rel="shortcut icon" href="Images/TabLogo.png">
  <!-- Bootstrap Core CSS -->
  <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

  <!-- Timeline CSS -->
  <link href="../dist/css/timeline.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header centered">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- /.navbar-header -->
      <div class="input-group custom-search-form sidebar-search col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-2">
        <input type="text" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <i class="fa fa-search"></i>
          </button>
        </span>
        <!-- Navigation -->
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #D80000">
              <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-comment fa-fw"></i> New Comment
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                    <span class="pull-right text-muted small">12 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-tasks fa-fw"></i> New Task
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a class="text-center" href="notifications.php">
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
            <!-- /.dropdown-alerts -->
          </li>
          <!-- /.dropdown -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #D80000">
              <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
              </li>
              <li><a href="#"><i class="fa fa-gear fa-fw"></i> Account Settings</a>
              </li>
              <li class="divider"></li>
              <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
              </li>
            </ul>
            <!-- /.dropdown-user -->
          </li>
          <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
      </div>
      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <div class="input-group custom-search-form">
              <div class="col-lg-12 hidden-xs">
                <img alt="140x140" src="Images/Logo.png" class="img-responsive" style="width:100%;height:100%;">
              </div>
            </div>
            <!-- /input-group -->
            <li>
              <a href="index.html" style="color: #D80000"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
              <a href="#" style="color: #D80000"><i class="fa fa-sitemap fa-fw"></i> Rooms<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="room.html" style="color: #D80000">Overview</a>
                </li>
                <li>
                  <a href="roomSettings.html" style="color: #D80000">Room Settings</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="notifications.php" style="color: #D80000"><i class="fa fa-table fa-fw"></i> Notifications</a>
            </li>
            <li>
              <a href="#"style="color: #D80000"><i class="fa fa-sitemap fa-fw"></i> Household<span class="fa arrow"></span></a>
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
              <a href="preferences.html" style="color: #D80000"><i class="fa fa-table fa-fw"></i>Preferences</a>
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
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th>Sensor ID</th>
                        <th>Comment</th>
                        <th>Date and Time</th>
                      </tr>
                    </thead>
                    <?php
                    include "connectToDatabase.php";

                    $sql = "SELECT * FROM log";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo "<tbody>";
                          echo "<tr class='odd gradeX'>";
                            echo "<td class='center'> $row[sensor_id] </td>";
                            echo "<td class='center'> $row[comment] </td>";
                            echo "<td class='center'> $row[date] </td>";
                            echo "</tr>";
                            echo "</tbody>";
                          }
                        }
                        $conn->close();
                        ?>
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
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../bower_components/raphael/raphael-min.js"></script>
        <script src="../bower_components/morrisjs/morris.min.js"></script>
        <script src="../js/morris-data.js"></script>



        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

      </body>

      </html>
