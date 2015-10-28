<?php
$title = "Spot History";
  $pageName = "Spots";
?>

<!DOCTYPE html>

<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
	</head>
	<body>
	
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
	

  
		
	</div>
	
	</body>
	
	
</html>
	
