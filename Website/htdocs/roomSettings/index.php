<?php
	$title = "Room Settings";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-comments fa-5x"></i>
						</div>
						<div class="col-xs-6 text-center">
							<div class="huge">Living Room</div>
							<div>Occupied</div>
						</div>
						<div class="col-xs-3">
							<i data-toggle="modal" data-target="#EditRoomModal" class="fa fa-pencil fa-2x pull-right"></i>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!--Modal-->
		<div class="modal fade" id="EditRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h2 class="modal-title" id="myModalLabel">Edit Room</h2>
					</div>
					<div class="modal-body row">
						<div class="form-group col-lg-12">
							<label>Room Name:</label>
							<input class="form-control" placeholder="<get room name>">


						<div class="checkbox">
							<label>
								<input type="checkbox"><strong>View Room on Dashboard</strong>
							</label>
						</div>

						<label>Colour:</label>
							<select class="form-control">
								<option>Red</option>
								<option>Yellow</option>
								<option>Blue</option>
								<option>Green</option>
							</select>
						<label>Icon:</label>
							<select class="form-control">
								<option value="fa-plus"></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						<label><h3>Room sensors:</h3></label>
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
							</table>
						</div>

						<label><h3>Room switches:</h3></label>
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
							</table>
						</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-cutlery fa-5x"></i>
						</div>
						<div class="col-xs-6 text-center">
							<div class="huge">Kitchen</div>
							<div>Unoccupied</div>
						</div>
						<div class="col-xs-3">
							<i data-toggle="modal" data-target="#EditRoomModal" class="fa fa-pencil fa-2x pull-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-6 text-center">
							<div class="huge">Bedroom</div>
							<div>Unoccupied</div>
						</div>
						<div class="col-xs-3">
							<i data-toggle="modal" data-target="#EditRoomModal" class="fa fa-pencil fa-2x pull-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-briefcase fa-5x"></i>
						</div>
						<div class="col-xs-6 text-center">
							<div class="huge">Office</div>
							<div>Unoccupied</div>
						</div>
						<div class="col-xs-3">
							<i data-toggle="modal" data-target="#EditRoomModal" class="fa fa-pencil fa-2x pull-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="col-lg-12">
			<button type="button" class="btn btn-danger huge center-block" data-toggle="modal" data-target="#AddRoomModal"><i class="fa fa-plus fa-2x img-center"></i></button>
	</div>
	<div class="modal fade" id="AddRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h2 class="modal-title" id="myModalLabel">Add Room</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
							<label>Room Name:</label>
							<input class="form-control" placeholder="<get room name>">


						<div class="checkbox">
							<label>
								<input type="checkbox"><strong>View Room on Dashboard</strong>
							</label>
						</div>

						<label>Colour:</label>
							<select class="form-control">
								<option>Red</option>
								<option>Yellow</option>
								<option>Blue</option>
								<option>Green</option>
							</select>
						<label>Icon:</label>
							<select class="form-control">
								<option></option>
								<option></option>
								<option></option>
								<option></option>
							</select>
						<label><h3>Room sensors:</h3></label>
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
							</table>
						</div>

						<label><h3>Room switches:</h3></label>
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
							</table>
						</div>
						</div>

				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
	</div>
<!-- /#page-wrapper -->
<?php
	include $path."footer.php"
?>

<?php else : ?>
<?php endif; ?>
