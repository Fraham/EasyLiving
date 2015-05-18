$(function () {
  $("#propertySelect").change(function()
  {
    var houseID = $('#propertySelect').val();

    var url = "?propertyID=" + houseID + "&option=room";

    $.post("getNotificationsGraph.php" + url, function( data )
    {
      $("#roomSelect").html( data );
    });

    url = "?propertyID=" + houseID + "&option=sensor";

    $.post("getNotificationsGraph.php" + url, function( data )
    {
      $("#sensorSelect").html( data );
    });
  });
  


  $( "#roomSelect" ).change(function()
  {
    var roomID = $('#roomSelect').val();

    var url = "?roomID=" + roomID;

    $.post("getNotificationsGraph.php" + url, function( data )
    {
      $("#sensorSelect").html( data );
    });
  });



  $( "#sensorSelect" ).change(function() {
    //alert( "Handler for .change() called." );
  });
});
