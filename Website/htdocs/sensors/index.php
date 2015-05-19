<?php
  $title = "Sensors";
  $path = "../src/templates/";
  include $path."main.php";
?>

<?php if (login_check($conn) == true) : ?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
      $sensorID = $_POST['id'];
      $sensorName = $_POST['name'];
      $messageOn = $_POST['messageOn'];
      $messageOff = $_POST['messageOff'];
      $room = $_POST['room'];
      require "../src/connect.php";

      $userID = $_SESSION['user_id'];
        $statement = "INSERT INTO sensors VALUES('$sensorID', '$sensorName', '$messageOn', '$messageOff','$room','0')";
        if ($conn->query($statement) === TRUE){}
      
      

      $conn->close();

    }
  ?>
  <div class="row">
    <?php
      include("../notifications/getNotificationsGraph.php");
      getRoomsAsPanels();
    ?>
  </div>
  <div class="row">
    <div class="col-lg-12 col-sm-12">
      <button class="btn btn-danger center-block btn-lg" data-toggle="modal" data-target="#AddModal"><i class="fa fa-plus"></i></button>
    </div>
  </div>

  <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title" id="myModalLabel">Add Sensor</h2>
        </div>
        <div class="modal-body row">
          <div class="form-group col-lg-12">
            <form action="index.php" method="post">
              <label>Sensor ID:</label> <input type="number" maxlength="6" name="id" autofocus class="form-control"/>
              <br>
              <label>Sensor Name:</label> <input type="text" id="Name" name="name" class="form-control"/>
              <br>
              <label>Message when activated</label> <input type="text" name="messageOn" autofocus class="form-control"/>
              <br>
              <label>Message when deactivated</label> <input type="text" name="messageOff" autofocus class="form-control"/>
              <br>
              <label>Sensor Type</label>
              <select class="form-control" name="sensorTyp">
                <?php
                  getSensorTypes(0);
                ?>
              </select>
              <br>
              <label>Room</label>
              <select class="form-control" name="room">
                <?php
                  getRooms(0);
                ?>
              </select>
              <br>
              <button type="submit" class="btn btn-lg btn-danger btn-block" name="add" >Add Sensor</button>
              <input type="button" value="Cancel" class="btn btn-lg btn-danger btn-block" data-dismiss="modal" aria-hidden="true" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
function deleteSensor(ID){
  $.post( "../delete.php", { sensorID:ID } );
}  

</script>

	<?php
		include $path."footer.php"
	?>
  
<?php else : ?>
<?php endif; ?>

