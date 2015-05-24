<?php
$title = "My Locations";
$path = "../src/templates/";
include $path."main.php";
require_once('../src/classes/PropertyClass.php');
?>

<?php if (login_check($conn) == true) : ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="dataTable_wrapper">
				<table class="table table-striped table-bordered table-hover" id="propertyTable">
					<thead>
						<tr>
							<th>Property ID</th>
							<th>Password</th>
							<th>Default Name</th>
							<th>User Name</th>
							<th>Edit</th>
						</tr>
					</thead>
					<?php
						$userID = $_SESSION['user_id'];

						$properties = [];

						$properties = Property::getByUserID($userID);

						foreach ($properties as $property)
						{
							$property->__getTableFormat();
						}
					?>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#AddPropertyModal">Add Property</button>
		<button href="../buyNewHouse" class="btn btn-lg btn-danger" onclick="../buyNewHouse">Buy New Property</button>
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
							<input type="button" value="Edit Property" class="btn btn-lg btn-danger btn-block" id="submitButton" onclick="submitForm();" />
							<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		function showForm(propertyID, password, defaultName, userName)
		{
			document.forms["editProperties"]["propertyID"].value = propertyID;
			document.forms["editProperties"]["password"].value = password;
			document.forms["editProperties"]["defaultName"].value = defaultName;
			document.forms["editProperties"]["userName"].value = userName;
			
			$('#AddModal').modal('show');	
		}
		
		function submitForm()
		{
			$.post('editProperty.php', $('#editProperties').serialize())
			.done(function( data ) {
				//console.log(data);
				location.reload();
			});
		};
	</script>

<?php
include $path."footer.php";
?>

<?php else : ?>
<?php endif; ?>
