<?php
	$title = "Buy New House";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<div class = "col-lg-6">
	<div class = "panel panel-danger">
		<div class = "panel-heading"> <h2> New House Preferences </h2> </div>
		<div class = "panel-body">
			<form>
				<label>House Name:*</label>
				<input class ="form-control col-lg-6">
			</form>
		</div>
	</div>
</div>

	<div class = "col-lg-6">
		<div class = "panel panel-danger">
			<div class = "panel-heading"> <h2> Payment Details </h2> </div>
			<div class = "panel-body">

			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class = "col-lg-12">
		<button type="button" class="btn btn-lg btn-danger pull-center" >Cancel</button>
		<button type="button" class="btn btn-lg btn-danger pull-right" >Submit</button>
	</div>
</div>

<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>
