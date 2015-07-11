updateMenu()

function updateMenu()
{
  $("#propertyMenuSelect").empty();

  $.ajax(
    {
      url: '../src/templates/updateMenu.php',
      dataType: 'json',
      async: true,
      success: function (result)
      {
        var propertyData = result['data'];
        var currentHouse = result['currentHouse'];
        var userID = result['userID'];

        for (var j = 0; j < propertyData.length; j++) {
          var button = currentHouse !== propertyData[j]["houseID"] ? "btn-default" : "btn-danger";

          $('#propertyMenuSelect').append($('<input />', {
            onclick: "clickButton(" + propertyData[j]["houseID"] + "," + userID + ")",
            type: "button",
            id: "houseMenu",
            value: propertyData[j]["userName"],
            class: "btn btn-md " + button + " btn-block",
            style: "margin-top:5px;"
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

function clickButton(houseID, userID)
{
  $.post("../src/templates/changeHouse.php", { func: "changeHouse", houseID: houseID, user_id: userID })
    .done(function (data)
    {
      updateMenu();
      reloadPage();
    });
}