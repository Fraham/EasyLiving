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
	<div id="userPref" class="tab-pane fade in active">
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
								<option>Email and Push Notifications</option>
							</select>
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
						<div class="col-lg-6">
							Password
							<input type="text" class="form-control" placeholder="******">
						</div>
					</div>
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
