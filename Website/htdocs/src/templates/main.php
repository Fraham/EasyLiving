<!DOCTYPE html>

<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<title><?php echo $title; ?></title>

		<link rel='shortcut icon' href='images/TabLogo.png'> <!-- favicon -->
		<script src='<?php echo $path; ?>../bower_components/jquery/dist/jquery.min.js'></script>
		<link href='<?php echo $path; ?>../bower_components/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../bower_components/metisMenu/dist/metisMenu.min.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../dist/css/timeline.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../dist/css/sb-admin-2.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../bower_components/morrisjs/morris.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../bower_components/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
		<script src='<?php echo $path; ?>../bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
		<script src='<?php echo $path; ?>../bower_components/metisMenu/dist/metisMenu.min.js'></script>
		<script src='<?php echo $path; ?>../dist/js/sb-admin-2.js'></script>
		
		<div id='wrapper'>
			<nav class=' navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
				<div class='navbar-header centered'>
					<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
						<span class='sr-only'>Toggle navigation</span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<div class ='clearfix'></div>
					<a href="../../dashboard"><img src='<?php echo $path; ?>../images/logoFlat.png' class='hidden-lg hidden-sm hidden-md img-responsive' style='width:35%;height:35%; margin:auto; padding:0px'></a>
				</div>
				<ul class='nav navbar-top-links navbar-right pull-right'>
					<li class='dropdown'>
						<a class='dropdown-toggle' style='color:#D80000' data-toggle='dropdown' href='#'>
							<i class='fa fa-user fa-fw'></i>  <i class='fa fa-caret-down'></i>
						</a>
						<ul class='dropdown-menu dropdown-user'>
							<div style='text-align: center'><h4> Available Houses</h4></div>

							<li class='divider'></li>
							<p style = 'text-align: center'>******php to pull all households to available******</p>
							<li class='divider'></li>
							<li><a href='#'><i class='fa fa-plus fa-fw'></i> Add House</a></li>
							<li><a href='../login'><i class='fa fa-sign-out fa-fw'></i> Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			<div class='navbar-default sidebar' role='navigation'>
				<div class='sidebar-nav navbar-collapse'>
					<ul class='nav' id='side-menu'>
						<div class='hidden-xs'>
							<a href="../../dashboard"><img src='<?php echo $path; ?>../images/logo.png' class='img-responsive'></a>
						</div>
						<?php include 'getMenu.php';?>
					</ul>
				</div>
			</div>
			

			<div id='page-wrapper'>
				<div class='row'>
					<div class='col-lg-12'>
						<h1 class='page-header'><?php echo $title; ?></h1>
					</div>
				</div>
	</head>
	<body>