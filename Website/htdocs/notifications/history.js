updatePropertyList();
updateRoomsList();
updateSensorsList();

$(function () {
  $("#propertySelect").change(function () {
    updateRoomsList();

    updateSensorsList();
  });



  $("#roomSelect").change(function () {
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
      data: { action: "updatePropertyList" },
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

function confirm() {
  var url = "";

  var houseID = $('#propertySelect').val();

  var roomID = $('#roomSelect').val();

  var sensorID = $('#sensorSelect').val();

  try {
    var start = $("#startDate").datepicker('getDate');

    var startDate = start.toISOString().slice(0, 11).replace(' ', '').replace('T', '');

    startDate = startDate + " 00:00:00";
  }
  catch (err) {
    startDate = "1970-02-01 00:00:00"
  }

  try {
    var end = $("#endDate").datepicker('getDate');

    var endDate = end.toISOString().slice(0, 11).replace(' ', '').replace('T', '');

    endDate = endDate + " 23:59:59";
  }
  catch (err) {
    endDate = "2020-02-01 00:00:00"
  }

  url = "?propertyID=" + houseID + "&roomID=" + roomID + "&sensorID=" + sensorID + "&startDate=" + startDate + "&endDate=" + endDate;

  table.fnClearTable();

  $.getJSON("getTableJSON.php" + url, function (data) {
    $('#notifications').dataTable().fnAddData(data);
  });

  changeGraph(url);
}

function reloadPage() {

}
