<?php
	include_once "$path../includes/functions.php";
	include_once "$path../connect.php";

	sec_session_start();
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<title><?php echo $title; ?></title>

		<link rel='shortcut icon' href='<?php echo $path; ?>../images/TabLogo.png'>
		<script src='<?php echo $path; ?>../bower_components/jquery/dist/jquery.min.js'></script>
		<link href='<?php echo $path; ?>../bower_components/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../bower_components/metisMenu/dist/metisMenu.min.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../dist/css/timeline.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../dist/css/sb-admin-2.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../bower_components/morrisjs/morris.css' rel='stylesheet'>
		<link href='<?php echo $path; ?>../bower_components/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
		<link href='<?php echo $path; ?>../datepicker/datepicker.css' rel='stylesheet'>
		<script src='<?php echo $path; ?>../bower_components/bootstrap/dist/js/bootstrap.min.js'></script>
		<script src='<?php echo $path; ?>../bower_components/metisMenu/dist/metisMenu.min.js'></script>
		<script src='<?php echo $path; ?>../dist/js/sb-admin-2.js'></script>
		<script src='<?php echo $path; ?>../datepicker/bootstrap-datetimepicker.js'></script>
		<script src='<?php echo $path; ?>../datepicker/bootstrap-datepicker.js'></script>
		<script src='<?php echo $path; ?>../js/sortable.js'></script>
		<script src='<?php echo $path; ?>../js/jquery.bind.sortable.js'></script>
		<link href='<?php echo $path; ?>../css/easyLiving.css' rel='stylesheet'>


		<div id='wrapper'>
			<?php if (login_check($conn) == true) : ?>
			<nav class=' navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
				<div class='navbar-header centered'>
					<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
						<span class='sr-only'>Toggle navigation</span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<div class ='clearfix'></div>
					<a href="../../dashboard"><img src='<?php echo $path; ?>../images/logoFlat.png' class='hidden-lg hidden-sm hidden-md img-responsive' style='width:60%;height:60%; margin:auto; padding:0px'></a>
				</div>

				<div class="dropdown nav navbar-top-links navbar-right pull-right" id="userDropdown">
					<button class="btn btn-default btn-lg" onclick="" style='color:#D80000' type="button" id="menu1" data-toggle="dropdown">
						<i class='fa fa-home fa-fw'></i>  <i class='fa fa-caret-down'></i>
					</button>
					<ul class="dropdown-menu">
						<li style='text-align: center'><h4> Available Properties</h4></li>

						<li class='divider'></li>
						
						<div>
							<input type="button" id="name" value="Property Name"class="btn btn-md btn-default btn-block" style="margin-top:5px;"></input>
						</div>
						<div>
							<input type="button" value="Property Name"class="btn btn-md btn-default btn-block" style="margin-top:5px;"></input>
						</div>
						<div class="divider"></div>
						<li><a data-toggle="modal" data-target="#AddPropertyModal"><i class='fa fa-plus fa-fw'></i> Add Property</a></li>
						<li><a href="../buyNewHouse/"><i class="fa fa-gbp fa-fw"></i> Buy New Property</a></li>
						<li><a href="<?php echo $path; ?>../includes/logout.php"><i class='fa fa-sign-out fa-fw'></i> Logout</a></li>
					</ul>
				</div>
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


			<div class="" id='page-wrapper' style="position:relative; ">
				<div class='row'>
					<div class='col-lg-12'>
						<h1 class='page-header'><?php echo $title; ?></h1>
					</div>
				</div>
			<?php else : ?>
				<div class="veritcal-center" style="padding-top: 15%;">
					<img src='<?php echo $path; ?>../images/logo.png' class="hidden-xs center-block" style='width:25%; height:25%; margin:auto; padding:0px'>
					<img src='<?php echo $path; ?>../images/logoFlat.png' class="hidden-lg hidden-md hidden-sm center-block" style='width:100%;height:100%; margin:auto; padding:0px'>
					<h1 style="color:#D80000; text-align:center;">
						You are not authorized to access this page. 
					</h1>
					<br>
						<div class="text-center">
							<a href="../login" class="btn btn-danger huge btn-lg text-center-block">Login</a>
						</div>
						
				</div>



			<?php endif; ?>

	</head>
	<body>
    <div class="modal fade" id="AddPropertyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title" id="myModalLabel">Add Property</h2>
          </div>
          <div class="modal-body row">
            <div class="form-group col-lg-12">
               <form action="../src/includes/process_login.php" method="post" name="login_form">
                Property ID: <input type="text" name="email" autofocus class="form-control"/>
                <br>
                Property Password: <input type="password"
                                 name="password"
                                 id="password"
                                 class="form-control"/>
                <br>
                <input type="button"
                       value="Add Property"
                       class="btn btn-lg btn-danger btn-block"
                       onclick="formhash(this.form, this.form.password);" />
                <input type="button"
                       value="Cancel"
                       class="btn btn-lg btn-danger btn-block"
                       data-dismiss="modal" aria-hidden="true" />
            </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    </body>

    <script>
    function keepOpen(){
    	document.getElementById("userDropdown").className += "open";
    }	
    function edit(){
    	document.getElementById("name").className = "form-control";
    	
    	document.getElementById("name").type = "Text";
    }
    </script>