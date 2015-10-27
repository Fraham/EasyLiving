<?php
$title = "Spot History";
  $pageName = "Spots";
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
		<script src='<?php echo $path; ?>../js/annyang.min.js'></script>
		<link href='<?php echo $path; ?>../css/easyLiving.css' rel='stylesheet'>
	
	<div class="row">
        <div class="col-lg-12">
            <!-- /.panel-heading -->
              <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                        <th>SPOT ID</th>
                        <th>Zone</th>
						<th>Current Light</th>
						<th>Current temp</th>
						<th>History</th>
                    </tr>
                  </thead>
				  <?php
				  	include "getSpots.php";
				  ?>
				  </div>
		</div>
	</div>
	
	
	
</html>
	
