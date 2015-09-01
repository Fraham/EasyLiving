<?php
	$title = "Property Residents";
  $pageName = "residents";
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
                      <th>Current Property</th>
                    </tr>
                  </thead>
									<?php
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
