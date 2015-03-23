 <!-- Custom Fonts -->
  <link href="../src/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   <link href="../src/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/JavaScript" src="../src/js/sha512.js"></script>
  <script type="text/JavaScript" src="../src/js/forms.js"></script>
</head>
<body>
    <div class="col-lg-6 ">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <img  src="../src/images/logo.png" class="pull-right" style="width:60%;height:50%; padding:0px;">
    </div>

    <div class="col-lg-6">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>  
        <br>
        <br>
        <br>
        <br>

        <div class="col-lg-6 col-md-6 col-sm-6">
          <button
              class="btn   btn-danger btn-lg"
              data-toggle="modal" data-target="#signUpModal">
              Sign up
          </button>  
          <div class="clearfix"></div>   
          <br>   
          <button
            class="btn btn-danger btn-lg" 
            data-toggle="collapse" data-target="#demo">
            Sign in
          </button>
                  
          <div id="demo" class="collapse">
              <?php
              if (isset($_GET['error'])) {
                  echo '<p class="error">Error Logging In!</p>';
              }
              ?>
                <form action="../src/includes/process_login.php" method="post" name="login_form">
                <br>
                    Email: <input type="text" name="email" autofocus class="form-control"/>
                    Password: <input type="password"
                                     name="password"
                                     id="password"
                                     class="form-control"/>
                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                    <input type="button"
                           value="Login"
                           class="btn btn-lg btn-danger btn-block"
                           onclick="formhash(this.form, this.form.password);" />
                </form>
            </div>
        </div>
      </div>

        



  <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title" id="myModalLabel">Sign up</h2>
        </div>
        <div class="modal-body row">
          <div class="form-group col-lg-12">
            <form method="post" name="registration_form">
                Email: <input type="text"
                                name="email"
                                id="email"
                                class="form-control"
                                placeholder="Example:smithjohn@example.com"/><br>
                Password: <input type="password"
                                 name="password"
                                 id="password"
                                 class="form-control"
                                 /><br>
                Confirm password: <input type="password"
                                         name="confirmpwd"
                                         id="confirmpwd"
                                         class="form-control" /><br>
                <input type="button"
                       value="Register"
                       class="btn btn-lg btn-danger btn-block"
                       onclick="return regformhash(this.form,
                                       this.form.email,
                                       this.form.password,
                                       this.form.confirmpwd);" />
                <input type="button"
                       value="Cancel"
                       class="btn btn-lg btn-danger btn-block"
                       data-dismiss="modal" aria-hidden="true" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  function verify(){
    if(document.getElementById("email").value != null && document.getElementById("password")!= null){
      var e-mail = document.getElementById("email").value;
      var password = document.getElementById("password").value;



    }
  }

  </script>

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
