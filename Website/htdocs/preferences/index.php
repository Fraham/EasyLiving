<?php
$title = "Preferences";
$path = "../src/templates/";
include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<script> type="text/javascript">
$(document).ready(function(){ 
    $("#myTab li:eq(1) a").tab('show');
});
</script>

<ul class="nav nav-tabs" id="myTab">
  <li role="presentation" class="active"><a href="#userPref">User Preferences</a></li>
  <li role="presentation"><a href="#accountSettings">General Account Settings</a></li>
</ul>

<div class="tab-content">
	<div id="userPref" class="tab-pane fade active">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<a><div class="panel-heading" data-parent="#accordion" href="#userBody"></a>
						User Preferences
					</div>
					<div class="panel-body"id="userBody">
						<div class="col-lg-6">
							<label>Notification Type:</label>
							<select class="form-control">
								<option>Push Notifications</option>
								<option>Email Notifications</option>
								<option>Both Email and Push Notifications</option>
							</select>
						</div>
						<div class="row">
							<div class="col-lg-6">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="accountSettings" class="tab-pane">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<a><div class="panel-heading"data-parent="#accordion" href="#houseBody"></a>
						General Account Settings
					</div>
					<div class="panel-body"id="houseBody">
						<div class="col-lg-4">
							Password
						</div>
						<div class="col-lg-4">
							<input type="password" class="form-control" placeholder="******" disabled>
						</div>
						<div class="col-lg-2 col-md-3">
							<button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#EditModal">Edit</button>
						</div>
					</div>
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

	<?php
	include $path."footer.php";
	?>

<?php else : ?>
<?php endif; ?>
