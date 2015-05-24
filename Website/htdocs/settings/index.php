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
<div class="row">
 <h3 class="page-header">User Preferences</h3>
    <div class="col-lg-6">
		<label>Notification Type:</label>
		<select class="form-control">
			<option>None</option>
			<option>Email</option>
		</select>
	</div>
</div>
<div class="row">
	<h3 class="page-header">General Account Settings</h3>
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
</div>	


<div class="modal fade" id="EditPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="myModalLabel">Change Password</h2>
			</div>
			<div class="modal-body row">
				<div class="form-group col-lg-12" style="margin:10px">
					<form action="" method="post" id="changePassword" name="changePassword">
						<label>Old Password:</label> <input type="password" id="oldPassword" class="form-control"/>
						<label>New Password:</label> <input type="password" id="newPassword" class="form-control"/>
						<label>Confirm Password:</label> <input type="password" id="confirmPassword" class="form-control"/>
						<input type="button" value="Confirm" class="btn btn-lg btn-danger btn-block" onclick="changePassword()" />
						<input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
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
            	<div class="form-group col-lg-12" style="margin:10px">
               		<form action="" method="post" id="changeEmail" name="changeEmail">
		                <label>New Email:</label> <input type="email" id="oldEmail" class="form-control"/>
		                <label>Confirm New Email:</label> <input type="email" id="newEmail" class="form-control"/>
		                <input type="button" value="Confirm" class="btn btn-lg btn-danger btn-block" onclick="changeEmail()" />
		                <input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
					</form>
            	</div>
          	</div>
        </div>
	</div>
</div>
<script>
	function changePassword()
	{
		if($('#newPassword').val()!=$('#oldPassword').val())
		{
      		alert("Passwords don't match. Please try again");
		}
		else
		{
			$.post('chnagePassoword.php', $('#changePassword').serialize())
			.done(function( data ) {
				console.log(data);
				//location.reload();
			});
		}
	};
	
	function changeEmail()
	{
		if($('#newEmail').val()!=$('#oldEmail').val())
		{
      		alert("Emails don't match. Please try again");
		}
		else
		{
			$.post('changeEmail.php', $('#changeEmail').serialize())
			.done(function( data ) {
				console.log(data);
				//location.reload();
			});
		}
		
	};
</script>
	<?php
	include $path."footer.php";
	?>

<?php else : ?>
<?php endif; ?>
