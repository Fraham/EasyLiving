<?php

include_once "../src/connect.php";
include_once "../src/includes/functions.php";

	session_start();
  session_write_close();

if (login_check($conn) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Easy Living Login</title>
  <link rel="shortcut icon" href="../src/images/TabLogo.png">

  <link href="../src/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../src/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
  <link href="../src/dist/css/sb-admin-2.css" rel="stylesheet">
  <link href="../src/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <script type="text/JavaScript" src="../src/js/sha512.js"></script>
  <script type="text/JavaScript" src="../src/js/forms.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <img alt="140x140" src="../src/images/logo.png" class="img-responsive center-block" style="width:50%;height:50%; padding:0px;">
          </div>
          <div class="panel-body">
            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error">Email or Password incorrect. Please try again</p>';
            }
            ?>
            <form action="../src/includes/process_login.php" method="post" name="login_form">
                Email: <input type="text" id="email" name="email" autofocus class="form-control" onkeypress="keyPress(event)" />
                <br>
                Password: <input type="password"
                                 name="password"
                                 id="password"
                                 class="form-control"
                                 onkeypress="keyPress(event)" />
                <br>
                <input type="button"
                      id="login_button"
                       value="Login"
                       class="btn btn-lg btn-danger btn-block"
                       onclick="formhash(this.form, this.form.password<?php if (isset($_GET['return'])) { echo ", '" . $_GET['return'] . "'";  } ?>);" />
                <a href="../createAccount" class="btn btn-lg btn-danger btn-block">Create a New Account</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  function verify(){
    if(document.getElementById("email").value != null && document.getElementById("password")!= null){

      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

    }
  }

  email.addEventListener("keypress", function() {
    if(e.keyCode == 13){
      document.getElementById('login_button').click();
    }
  });

    password.addEventListener("keypress", function() {
    if(e.keyCode == 13){
      document.getElementById('login_button').click();
    }
  });


  </script>
  <script src="../src/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../src/bower_components/metisMenu/dist/metisMenu.min.js"></script>
  <script src="../src/dist/js/sb-admin-2.js"></script>
</body>
</html>
