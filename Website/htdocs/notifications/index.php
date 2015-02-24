<?php
	$title = "Notifications";
	$path = "../src/templates/";
	include $path."main.php";
?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <a><div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#chartBody"></a>
        Notification charts
      </div>
      <div class="panel-body panel-collapse collapse"id="chartBody">
        <div> 
          <div class="col-lg-3 col-md-3">
                  <select class="form-control">
                    <option selected hidden>Room:</option>
                  </select>
            </label>
          </div>
          <div class="col-lg-3 col-md-3">
                  <select class="form-control">
                    <option selected hidden>Sensor:</option>
                  </select>
            </label>
          </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <input  class="form-control" placeholder="Start Date"  id="startDate">
          </div>
          <div class="col-lg-3 col-md-3">
            <input  class="form-control" placeholder="End Date"  id="endDate">
          </div>
        </div>
        <div>
          

        </div>
      </div>
      </div>
    </div>



    <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#startDate').datepicker({
                    format: "dd/mm/yyyy"
                }); 
                $('#endDate').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            
            });
        </script>




    <div class="panel panel-default">
      <a><div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#notiBody"></a>
        Notifications Tables
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body panel-collapse collapse" id="notiBody">
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

<?php
	include $path."footer.php"
?>