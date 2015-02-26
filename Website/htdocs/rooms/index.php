<?php
  $title = "Rooms Overview";
  $path = "../src/templates/";
  include $path."main.php";
?>


<div class="col-lg-12" id = "roomsPanel">

  <?php
    // $blockSize = 500;
    include "../src/func/getRooms.php";
  ?>

  <div class="clearfix visible-md-block visible-lg-block"></div>
  <div class="clearfix visible-md-block"></div>

</div>

<?php include $path."footer.php"; ?>
