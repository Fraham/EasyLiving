<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Easy Living Create Account </title>
  <link rel="shortcut icon" href="../src/images/TabLogo.png">
  <!-- Bootstrap Core CSS -->
  <link href="../src/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="../src/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../src/dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../src/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <img src="../src/images/logo.png" class="img-responsive center-block" style="width:50%;height:50%; padding:0px;">
          </div>
          <div class="panel-body">
            <form role="form">
              <fieldset>
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" placeholder="Example:smithjohn@example.com">
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control" name="password" type="password" value="">
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <input class="form-control" name="password" type="password" value="">
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <a type="submit" class="btn btn-lg btn-danger btn-block"
                onclick="return regformhash(this.form,
                                this.form.username,
                                this.form.email,
                                this.form.password,
                                this.form.confirmpwd);">Create Account</a>
                <a href="../login" class="btn btn-lg btn-danger btn-block">Cancel</a>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../src/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="../src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="../src/bower_components/metisMenu/dist/metisMenu.min.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="../src/dist/js/sb-admin-2.js"></script>

</body>

</html>
