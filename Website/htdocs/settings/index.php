<?php
$title = "Settings";
$path = "../src/templates/";
include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<script> type="text/javascript">
$(document).ready(function(){ 
    $("#myTab li:eq(1) a").tab('show');
});
</script>

<div class="tabbable">
  <ul class="nav nav-tabs">
    <li><a href="#pane1" data-toggle="tab">User Preferences	</a></li>
    <li class="active"><a href="#pane2" data-toggle="tab">General Account Settings</a></li>
  </ul>
  <div class="tab-content">
    <div id="pane1" class="tab-pane">
    	<h3 class="page-header">User Preferences</h3>
      	<div class="col-lg-6">
			<label>Notification Type:</label>
			<select class="form-control">
				<option>Push Notifications</option>
				<option>Email Notifications</option>
				<option>Email and Push Notifications</option>
			</select>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-6" style="margin-top:20px;">
				<label>Keep all Sensor and Event data for:</label>
				<select class="form-control">
					<option>1 month</option>
					<option>3 months</option>
					<option>6 months</option>
					<option>9 months</option>
					<option>12 months</option>
					<option>18 months</option>
					<option>24 months</option>
				</select>
		</div>
    </div>
    <div id="pane2" class="tab-pane active">
    	<h3 class="page-header">General Account Settings</h3>
		</div>
		<div class="col-lg-4" style="margin-bottom:10px;">
			<strong>Email:</strong>
		</div>
		<div class="col-lg-4" style="margin-bottom:10px;" >
			<input type="Text" class="form-control" placeholder="" disabled>
		</div>
		<div class="col-lg-2 col-md-3">
			<button type="button" class="btn btn-lg btn-danger" style="margin-bottom:10px;" data-toggle="modal" data-target="#EditEmailModal">Edit</button>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-4" style="margin-bottom:10px;">
			<strong>Password:</strong>
		</div>
		<div class="col-lg-4" style="margin-bottom:10px;">
			<input type="password" class="form-control" placeholder="******" disabled>
		</div>
		<div class="col-lg-2 col-md-3">
			<button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#EditPasswordModal">Edit</button>
		</div>
    </div>
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->

<div class="modal fade" id="EditPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<h2 class="modal-title" id="myModalLabel">Change Password</h2>
          </div>
          <div class="modal-body row">
            <div class="form-group col-lg-12">
               <form action="../src/includes/process_login.php" method="post" name="login_form">
                <label>Old Password:</label> <input type="password" id="oldPassword" class="form-control"/>
                <br>
                <label>New Password:</label> <input type="password" id="newPassword" class="form-control"/>
				<br>
                <label>Confirm Password:</label> <input type="password" id="confirmPassword" class="form-control"/>
				<br>
                <input type="button"
                       value="Confirm"
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
<div class="modal fade" id="EditEmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<h2 class="modal-title" id="myModalLabel">Change Email</h2>
          </div>
          <div class="modal-body row">
            <div class="form-group col-lg-12">
               <form action="../src/includes/process_login.php" method="post" name="login_form">
                <label>New Email:</label> <input type="email" id="oldPassword" class="form-control"/>
                <br>
                <label>Confirm New Email:</label> <input type="email" id="newPassword" class="form-control"/>
				<br>
                <input type="button"
                       value="Confirm"
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
