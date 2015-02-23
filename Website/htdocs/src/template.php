<!DOCTYPE html>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $title = "" ?>
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
		<nav class=" navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header centered">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class ="clearfix"></div>
				<img src="images/logoFlat.png" class="hidden-lg hidden-sm hidden-md img-responsive" style="width:35%;height:35%; margin:auto; padding:0px">
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
					<img src="images/logo.png" class="img-responsive" style="width:100%;height:100%;">
				</div>
				<?php include "getMenu.php"?>
			</ul>
        </div>
      </div>
	

    <div id="page-wrapper">
	    <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $title?> </h1>
			</div>
        <!-- /.col-lg-12 -->
		</div>
	</div>





      </head>

      </html>
