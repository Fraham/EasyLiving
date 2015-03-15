<?php
	$title = "My Locations";
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
                      <th>Rendering engine</th>
                      <th>Browser</th>
                      <th>Platform(s)</th>
                      <th>Engine version</th>
                      <th>CSS grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="odd gradeX">
                      <td>Trident</td>
                      <td>Internet Explorer 4.0</td>
                      <td>Win 95+</td>
                      <td class="center">4</td>
                      <td class="center">X</td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="odd gradeX">
                      <td>Trident</td>
                      <td>Internet Explorer 4.0</td>
                      <td>Win 95+</td>
                      <td class="center">4</td>
                      <td class="center">X</td>
                    </tr>
                  </tbody>
                  </table>
                </div>
             
              <input type="button"
                       value="Add Property"
                       class="btn btn-lg btn-danger pull-right"
                       data-toggle="modal" data-target="#AddPropertyModal" />
              <a href="../buyNewHouse"
                class="btn btn-lg btn-danger pull-right"
                onclick="../buyNewHouse" />
                Buy New Property
              </a> 
                
                
          </div>
        </div>





<?php
	include $path."footer.php";
?>

<?php else : ?>
<?php endif; ?>
