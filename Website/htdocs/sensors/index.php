<?php
	$title = "Sensors";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-danger">
			<div class="panel-heading" >
			<strong>Living Room</strong>
			</div>
			<div class="panel-body"id="chartBody">
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor1</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor2</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor3</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor4</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor5</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-warning">
			<div class="panel-heading" >
			<strong>Kitchen</strong>
			</div>
			<div class="panel-body"id="chartBody">
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor1</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor2</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor3</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor4</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor5</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading" >
			<strong>Bedroom</strong>
			</div>
			<div class="panel-body"id="chartBody">
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor1</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor2</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor3</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor4</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor5</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading" >
			<strong>Office</strong>
			</div>
			<div class="panel-body"id="chartBody">
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor1</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor2</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor3</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor4</a>
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="" class="btn btn-default btn-block" data-toggle="modal" data-target="#EditModal">Sensor5</a>
				</div>
				<br>
			</div>
		</div>
	</div>
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
                <label>Sesnor ID:</label> <input type="text" maxlength="6" name="ID" autofocus class="form-control"/>
                <br>
                <label>Sensor Name:</label> <input type="text"
                                 id="password"
                                 class="form-control"/>
                <br>
                <label>Sesnor Type</label>
						<select class="form-control">
							<option>Motion</option>
							<option>Door/Window</option>
							<option>Temperature</option>
						</select>
				<br>
				<label>Room</label>
						<select class="form-control">
							<option>Living Room</option>
							<option>Kitchen</option>
							<option>Bedroom</option>
							<option>Office</option>
						</select>
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

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title" id="myModalLabel">Add Sensor</h2>
          </div>
          <div class="modal-body row">
            <div class="form-group col-lg-12">
               <form action="../src/includes/process_login.php" method="post" name="login_form">
                <label>Sensor Name:</label> <input type="text"
                				value="*current sensor name*" 
                                 id="password"
                                 class="form-control"/>
                <br>
                <label>Sesnor Type</label>
						<select class="form-control">
							<option>Motion</option>
							<option>Door/Window</option>
							<option>Temperature</option>
						</select>
				<br>
				<label>Room</label>
						<select class="form-control">
							<option>Living Room</option>
							<option>Kitchen</option>
							<option>Bedroom</option>
							<option>Office</option>
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
