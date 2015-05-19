<?php
$title = "My Locations";
$path = "../src/templates/";
include $path."main.php";
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
						</tr>
					</thead>
					<?php

						require_once('../src/classes/PropertyClass.php');

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
		<div class="col-md-2">
			<input type="button" value="Add Property" class="btn btn-lg btn-danger pull-right" data-toggle="modal" data-target="#AddPropertyModal" />
		</div>

		<div class="col-md-2">
			<a href="../buyNewHouse" class="btn btn-lg btn-danger pull-right" onclick="../buyNewHouse" />
			Buy New Property
		</a>
		</div>
	</div>

<?php
include $path."footer.php";
?>

<?php else : ?>
<?php endif; ?>
