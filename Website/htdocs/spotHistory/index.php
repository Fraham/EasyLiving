<?php
$title = "Spot History";
  $pageName = "Spots";
	$path = "../src/templates/";
	include $path."main.php";
?>

<!DOCTYPE html>

<html>
	<script src='<?php echo $path; ?>../bower_components/jquery/dist/jquery.min.js'></script>
	<link href='<?php echo $path; ?>../bower_components/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
	
	<title>sunspots</title>
	
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
	
