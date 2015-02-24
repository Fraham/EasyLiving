<?php
	$title = "Notifications";
	$path = "../src/templates/";
	include $path."main.php";
?>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Notifications Tables
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <table class="table table-striped table-bordered table-hover" id="notifications">

                    <script>
                      refresh();

                      function refresh()
                      {
                        $.post("getNotificationTable.php", function( data ) {
                          $("#notifications").html( data );
                        });
                      }
                      var intervalID = setInterval(refresh, 500);
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php
	include $path."footer.php"
?>