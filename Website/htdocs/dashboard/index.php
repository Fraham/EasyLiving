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
<?php
	require_once "../src/template.php";
	$title	= 'Dashboard';
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
		<div class="col-lg-9">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-home fa-fw"></i> House Overview
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
        <div class="col-lg-12" id = "roomsPanel">
        <script>
          refresh();
          function refresh()
          {
            $.post( "../src/func/getRooms.php", function( data ) {
              $( "#roomsPanel" ).html( data );
            });
          }
          var intervalID = setInterval(refresh, 500);
        </script>

		<div class="clearfix visible-md-block visible-lg-block"></div>


		<div class="clearfix visible-md-block"></div>

	 </div>
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
	<script>	
		$('.btn-toggle').click(function() {
			$(this).find('.btn').toggleClass('active');  
    
			if ($(this).find('.btn-danger').size()>0) {
				$(this).find('.btn').toggleClass('btn-danger');
			}
			$(this).find('.btn').toggleClass('btn-default');
		});

		$('form').submit(function(){
			alert($(this["options"]).val());
			return false;
		});
	</script>

	</div>
	</div>
	</div>




        <!-- Bootstrap Core JavaScript -->
        <script src="../src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../src/bower_components/metisMenu/dist/metisMenu.min.js"></script>


        <!-- Custom Theme JavaScript -->
        <script src="../src/dist/js/sb-admin-2.js"></script>

      </body>

      </html>
