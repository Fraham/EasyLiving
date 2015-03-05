<?php
	$title = "Property Selection";
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
              <input type="button"
                       value="Buy New Property"
                       class="btn btn-lg btn-danger pull-right"
                       href="../buyNewHouse" />



          </div>
        </div>


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
                Property Password: <input type="password"
                                 name="password"
                                 id="password"
                                 class="form-control"/>
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



<?php
	include $path."footer.php";
?>

<?php else : ?>
<?php endif; ?>
