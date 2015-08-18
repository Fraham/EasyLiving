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

  /*$('#sensorSelect').append($('<option/>', {
    value: "Any",
    text: "Any"
  }));*/

  $.ajax(
    {
      url: 'history.php',
      dataType: 'json',
      async: true,
      data: { action: "updateSensorsList", roomID: $('#roomSelect').val(), propertyID: $('#propertySelect').val() },
      success: function (result) {
        var sensorData = result['data'];

        for (var j = 0; j < sensorData.length; j++) {
          /*$('#sensorSelect').append($('<option/>', {
            value: sensorData[j]["sensorID"],
            text: sensorData[j]["name"]
          }));*/

          var div =  $('<div/>', {
            class: "col-md-2"
          });
          var input = $('<input/>', {
            type: "checkbox",
            value: sensorData[j]["sensorID"],
            id: sensorData[j]["name"],
            class: "checkboxes",
            checked: "checked"
          });
          $(div).append(input);
          $(div).append( " " + sensorData[j]["name"]);

          $('#sensorSelectionPanelBody').append(div);
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });

    //confirm();
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
          /*$('#roomSelect').append($('<option/>', {
            value: roomData[j]["roomID"],
            text: roomData[j]["defaultName"]
          }));*/

          var div =  $('<div/>', {
            class: "col-md-2"
          });
          var input = $('<input/>', {
            type: "checkbox",
            value: roomData[j]["roomID"],
            id: roomData[j]["defaultName"],
            checked: "checked"
          });
          $(div).append(input);
          $(div).append( " " + roomData[j]["defaultName"]);

          $('#roomSelectionPanelBody').append(div);
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
          /*$('#propertySelect').append($('<option/>', {
            value: propertyData[j]["houseID"],
            text: propertyData[j]["userName"]
          }));*/

          var div =  $('<div/>', {
            class: "col-md-2"
          });
          var input = $('<input/>', {
            type: "checkbox",
            value: propertyData[j]["houseID"],
            id: propertyData[j]["houseID"],
            checked: "checked"
          });
          $(div).append(input);
          $(div).append( " " + propertyData[j]["userName"]);

          $('#propertySelectionPanelBody').append(div);
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

  /*var houseID = $('#propertySelect').val();

  var roomID = $('#roomSelect').val();

  var sensorID = $('#sensorSelect').val();*/

  var sets = 0;

  var sensorsWhere = "";

  $("#sensorSelectionPanelBody .checkboxes:checked").each(function(){
    if (sets === 0)
    {
      sets = 1;
      //sensorsWhere += " AND ";
    }
    else
      sensorsWhere = sensorsWhere + " OR ";

    sensorsWhere = sensorsWhere + "sensors.sensorID=" + $(this).attr("value") + "";
  });

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

  url = "";

  if (sets ===1)
    url = "?sensorsWhere=" + sensorsWhere + "&startDate=" + startDate + "&endDate=" + endDate;
  else
    url = "?startDate=" + startDate + "&endDate=" + endDate;

  table.fnClearTable();

  $.ajax(
    {
      url: "getTableJSON.php" + url,
      dataType: 'json',
      async: true,
      data: { action: "updatePropertyList" },
      success: function (result) {
        var error = result['error'];
        if (error === 0)
        {
          var data = result['data'];
          $('#notifications').dataTable().fnAddData(data);

          $("#historyTablePanel").show();
        }
        else
        {
          $("#historyTablePanel").hide();
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });

  changeGraph(url);

  changeTemperatureGraph(url);
}

function togglePanelSize(which) {
  var panel;
  var body;
  if (which == "temp")
  {
    panel = $('#temperaturePanelSize');
    body = $('#ChartBody');

    panel.toggleClass('col-sm-6 col-sm-12');
    chart.setSize($('#tempGraph').width(), body.height());
  }
  else{
    panel = $('#humidityPanelSize');
    body = $('#ChartBodyH');

    panel.toggleClass('col-sm-6 col-sm-12');
    chartH.setSize($('#humGraph').width(), body.height());
  }
}

function showSelection(panelBody)
{
  $("#" + panelBody).toggle("slow");
}

function reloadPage() {

}
