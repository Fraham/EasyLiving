updateTable();

function reloadPage()
{

}
function updateTable()
{
	//$("#tableContents").empty();
  $("#propertyTable").find("tr:gt(0)").remove();

  $.ajax(
    {
      url: 'locations.php',
      dataType: 'json',
      async: true,
      success: function (result) {
        var propertyData = result['data'];

        for (var j = 0; j < propertyData.length; j++) {
          var tr = $('<tr/>');

          var houseID = $('<td/>', { text: propertyData[j]["houseID"] } );

          var password = $('<td/>');

          password.append($('<input/>', {
             type : "button",
             value : "Show Password",
             class : "btn btn-danger btn-block",
             onClick : "showPassword('" + propertyData[j]['password'] + "')" }));

          var defaultName = $('<td/>', { text: propertyData[j]["defaultName"] } );

          var userName = $('<td/>', { text: propertyData[j]["userName"] } );

          var edit = $('<td/>');

          edit.append($('<input/>', {
            type : "button",
            value : "Edit",
            class : "btn btn-danger btn-block",
            onClick : "showForm('" + propertyData[j]["houseID"] + "', '"+ propertyData[j]['password'] + "', '" + propertyData[j]["defaultName"] + "', '" + propertyData[j]["userName"] + "')"}));

          tr.append(houseID);
          tr.append(password);
          tr.append(defaultName);
          tr.append(userName);
          tr.append(edit);

          $("#propertyTable").find('tbody').append($(tr));
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}