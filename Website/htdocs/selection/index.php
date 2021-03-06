<?php
$title = "My Locations";
$pageName = "selection";
$path = "../src/templates/";
include $path."main.php";
require_once('../src/classes/PropertyClass.php');
//sec_session_start();
	//session_start();
?>

<?php if (login_check($conn) == true) : ?>
	<script src="selection.js"></script>
	<div class="row">
		<div class="col-lg-12">
			<div class="dataTable_wrapper">
				<table class="table table-striped table-bordered table-hover" id="propertyTable">
					<tbody>
						<tr>
							<th>Property ID</th>
							<th>Password</th>
							<th>Default Name</th>
							<th>User Name</th>
							<th>Edit</th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#AddPropertyModal">Add Property</button>
		<a type="button" href="../buyNewHouse" class="btn btn-lg btn-danger"  onclick="../buyNewHouse"/>
				Buy New Property
		</a>
	</div>

	<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">Edit Property</h2>
				</div>
				<div class="modal-body row">
					<div class="form-group col-lg-12">
						<form class="form-horizontal" action="" method="post" id="editProperties" name="editProperties">
							<div class="form-group">
								<label for="propertyID" class="col-sm-2 control-label">Property ID</label>
								<div class="col-sm-10">
							    	<input type="text" class="form-control" id="propertyID" name="propertyID" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
							    	<input type="text" class="form-control" id="password" name="password">
								</div>
							</div>
							<div class="form-group">
								<label for="defaultName" class="col-sm-2 control-label">Default Name</label>
								<div class="col-sm-10">
							    	<input type="text" class="form-control" id="defaultName" name="defaultName">
								</div>
							</div>
							<div class="form-group">
								<label for="userName" class="col-sm-2 control-label">User Name</label>
								<div class="col-sm-10">
							    	<input type="text" class="form-control" id="userName" name="userName">
								</div>
							</div>
							<input type="button" value="Confirm" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">House Password</h2>
				</div>
				<div class="modal-body row">
					<form class="form-horizontal" action="" method="post" id="displayPassword" name="displayPassword">
							<div class="form-group">
								<label for="passwordIntro" class="col-sm-6 control-label">Your password for this property is: </label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="thePassword" name="thePassword">
								</div>
							</div>
							<input type="button" value="OK" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
include $path."footer.php";
?>

<?php else : ?>
<?php endif; ?>
