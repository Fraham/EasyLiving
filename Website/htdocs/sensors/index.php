<?php
	$title = "Sensors";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
<div class="row">

				<?php
					include("../notifications/getNotificationsGraph.php");
					getRoomsAsPanels();
				?>
</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12">
					<button class="btn btn-danger center-block btn-lg" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i></button>
					</div>
				</div>

    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title" id="myModalLabel">Add Sensor</h2>
          </div>
          <div class="modal-body row">
            <div class="form-group col-lg-12">
               <form action="../src/includes/process_login.php" method="post" name="login_form">
                <label>Sensor ID:</label> <input type="text" maxlength="6" name="ID" autofocus class="form-control"/>
                <br>
                <label>Sensor Name:</label> <input type="text"
                                 id="password"
                                 class="form-control"/>
                <br>
                <label>Sensor Type</label>
						<select class="form-control">
							<?php
								getSensorTypes(0);
							?>
						</select>
				<br>
				<label>Room</label>
						<select class="form-control">
							<?php
								getRooms(0);
							?>
						</select>
				<br>
                <input type="button"
                       value="Add Sensor"
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
	include $path."footer.php"
?>

<?php else : ?>
<?php endif; ?>
