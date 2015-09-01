<?php
	$title = "Buy New Property";
	$pageName = "buyNewHouse";
	$path = "../src/templates/";
	include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<div class = "col-lg-6">
	<div class = "panel panel-default">
		<div class = "panel-heading"> <h2> New Property Preferences </h2> </div>
			<div class = "panel-body">
			 <form method="post" id="registration_form" action="">
				 <div class="control-group">
        			<label class="control-label" for="name">Property Name</label>
					<div class="controls">
                		<input type="text" name="pName" id="pName" class="form-control danger" required/>
					</div>
				</div>
				<div class="control-group">
        			<label class="control-label" for="name">Password</label>
					<div class="controls">
                		<input type="password" name="password" id="password" class="form-control" required/>
					</div>
				</div>
				<div class="control-group">
        			<label class="control-label" for="name">Confirm Password</label>
					<div class="controls">
                		<input type="password" name="confirmpwd" id="confirmpwd" class="form-control" required />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	<div class = "col-lg-6">
		<div class = "panel panel-default">
			<div class = "panel-heading"> <h2> Payment Details </h2> </div>
			<div class = "panel-body">
				<form method="post" name="registration_form2" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                Name on Card: <input type="text"
                                name="cardName"
                                id="email"
                                class="form-control"
                                placeholder="Card Holder's Name"/><br>
                Card Number: <input type="text"
								 name="cardNo"
                                 class="form-control"
                                 /><br>
                Expiration Date: <br> <input  class="btn btn-default " readonly placeholder="Month"  id="month">
                				 <input  class="btn btn-default " readonly placeholder="Year"  id="year">

				<br>
				<br>
                Card CVV: <input type="password	"
                                         name="confirmpwd"
                                         id="confirmpwd"
                                         class="form-control" /><br>

                </form>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class = "col-lg-12">
		<button type="button" class="btn btn-lg btn-danger pull-right" onclick="submitForm()">Submit</button>
	</div>
</div>

<script>
	function submitForm()
	{
		if($('#password').val()!=$('#confirmpwd').val())
		{
      		alert("Passwords don't match. Please try again");
		}
		else
		{
			$.post('newHouse.php', $('#registration_form').serialize())
			.done(function( data ) {
				location.reload();
			});
		}
	};
</script>

<script type="text/javascript">
	$('#month').datepicker({
		format: 'MM (mm)',
		viewMode: "months",
    	minViewMode: "months",
		autoclose: true,
	});
	$('#year').datepicker({
		format: 'yyyy',
		viewMode: "years",
    	minViewMode: "years",
		autoclose: true,
	});
</script>

<?php include $path."footer.php"?>

<?php else : ?>
<?php endif; ?>
