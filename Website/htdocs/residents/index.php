<?php
	$title = "Household Residents";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

      <div class="row">
        <div class="col-lg-12">
            <!-- /.panel-heading -->
              <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Current Household</th>
                    </tr>
                  </thead>
									<?php
										$houseID = "111111";
										include "getResidents.php";
									?>
                </div>
          </div>
        </div>
<?php
	include $path."footer.php";
?>

<?php else : ?>
<?php endif; ?>
