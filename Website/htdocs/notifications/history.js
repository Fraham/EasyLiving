updatePropertyList();
updateRoomsList();
updateSensorsList();

$(function () {
  $("#propertySelect").change(function () {
    /*var houseID = $('#propertySelect').val();

    var url = "?propertyID=" + houseID + "&option=room";

    $.post("getNotificationsGraph.php" + url, function (data) {
      $("#roomSelect").html(data);
    });

    /*url = "?propertyID=" + houseID + "&option=sensor";

    $.post("getNotificationsGraph.php" + url, function (data) {
      $("#sensorSelect").html(data);
    });*/
    updateRoomsList();

    updateSensorsList();
  });



  $("#roomSelect").change(function () {
    /*var roomID = $('#roomSelect').val();

    var url = "?roomID=" + roomID;

    $.post("getNotificationsGraph.php" + url, function (data) {
      $("#sensorSelect").html(data);
    });*/


    updateSensorsList();
  });



  $("#sensorSelect").change(function () {
    var ID = $('#sensorSelect').val();
    var type = substr();
    //alert( "Handler for .change() called." );
  });
});

function updateSensorsList() {
  $("#sensorSelect").empty();

  $('#sensorSelect').append($('<option/>', {
    value: "Any",
    text: "Any"
  }));

  $.ajax(
    {
      url: 'history.php',
      dataType: 'json',
      async: true,
      data: { action: "updateSensorsList", roomID: $('#roomSelect').val(), propertyID: $('#propertySelect').val() },
      success: function (result) {
        var sensorData = result['data'];

        for (var j = 0; j < sensorData.length; j++) {
          $('#sensorSelect').append($('<option/>', {
            value: sensorData[j]["sensorID"],
            text: sensorData[j]["name"]
          }));
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}

function updateRoomsList() {
  $("#roomSelect").empty();

  $('#roomSelect').append($('<option/>', {
    value: "Any",
    text: "Any"
  }));

  $.ajax(
    {
      url: 'history.php',
      dataType: 'json',
      async: true,
      data: { action: "updateRoomsList", propertyID: $('#propertySelect').val() },
      success: function (result) {
        var roomData = result['data'];

        for (var j = 0; j < roomData.length; j++) {
          $('#roomSelect').append($('<option/>', {
            value: roomData[j]["roomID"],
            text: roomData[j]["defaultName"]
          }));
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}

function updatePropertyList() {
  $("#propertySelect").empty();

  $('#propertySelect').append($('<option/>', {
    value: "Any",
    text: "Any"
  }));

  $.ajax(
    {
      url: 'history.php',
      dataType: 'json',
      async: true,
      data: { action: "updatePropertyList"},
      success: function (result) {
        var propertyData = result['data'];

        for (var j = 0; j < propertyData.length; j++) {
          $('#propertySelect').append($('<option/>', {
            value: propertyData[j]["houseID"],
            text: propertyData[j]["userName"]
          }));
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}
