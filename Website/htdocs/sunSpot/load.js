var chartLight;
var chartTemperature;
var chartInteraction;

function loadTemperature() {
  var options = {
    chart:
    {
      renderTo: 'temperatureGraph',
      type: 'line'
    },
    credits:
    {
      enabled: false
    },
    title:
    {
      text: 'Temperature in the different zones',
      x: -6
    },
    subtitle:
    {
      text: '',
      x: -20
    },
    xAxis: {
      title:
      {
        text: 'Time'
      },
      type: 'datetime',
      crosshair: true,
      maxPadding: 0,
      minPadding: 0,
    },
    yAxis:
    {
      min: 0,
      title:
      {
        text: 'Temperature'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    legend:
    {
      title:
      {
        text: 'Zones'
      },
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 100,
      borderWidth: 0
    }
  };

  $.ajax(
    {
      url: "getJSONTemperature.php",
      dataType: 'json',
      async: true,
      success: function (result) {
        var error = result['error'];

        if (error === 0) {
          chartTemperature = new Highcharts.Chart(options);

          $.each(result.data, function (index, element) {
            var dataArray = [];
            $.each(element, function (index2, element2) {
              var tempArray = [];

              tempArray.push(Date.UTC(element2[0], element2[1] - 1, element2[2], element2[3], element2[4], element2[5]));
              tempArray.push(element2[6]);

              dataArray.push(tempArray);
            });

            chartTemperature.addSeries({
              name: index,
              data: dataArray
            });
          });
          //$("#container").show();*/
        }
        else {
          //$("#container").hide();
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}
function loadLight() {
  var options = {
    chart:
    {
      renderTo: 'lightGraph',
      type: 'line'
    },
    credits:
    {
      enabled: false
    },
    title:
    {
      text: 'Light levels in the different zones',
      x: -6
    },
    subtitle:
    {
      text: '',
      x: -20
    },
    xAxis: {
      title:
      {
        text: 'Time'
      },
      type: 'datetime',
      crosshair: true,
      maxPadding: 0,
      minPadding: 0,
    },
    yAxis:
    {
      min: 0,
      title:
      {
        text: 'Light Levels'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    legend:
    {
      title:
      {
        text: 'Zones'
      },
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 100,
      borderWidth: 0
    }
  };

  $.ajax(
    {
      url: "getJSONLight.php",
      dataType: 'json',
      async: true,
      success: function (result) {
        var error = result['error'];

        if (error === 0) {
          chartLight = new Highcharts.Chart(options);

          $.each(result.data, function (index, element) {
            var dataArray = [];
            $.each(element, function (index2, element2) {
              var tempArray = [];

              tempArray.push(Date.UTC(element2[0], element2[1] - 1, element2[2], element2[3], element2[4], element2[5]));
              tempArray.push(element2[6]);

              dataArray.push(tempArray);
            });

            chartLight.addSeries({
              name: index,
              data: dataArray
            });
          });
          //$("#container").show();*/
        }
        else {
          //$("#container").hide();
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}
function graphChange(zone)
{
  zone = zone - 1;
  if (chartTemperature.series[zone].visible)
  {
    chartTemperature.series[zone].hide();
    chartLight.series[zone].hide();
  }
  else
  {
    chartTemperature.series[zone].show();
    chartLight.series[zone].show();
  }  
}

function loadInteraction() {
    var options = {
    chart:
    {
      renderTo: 'interactionGraph',
      type: 'line'
    },
    credits:
    {
      enabled: false
    },
    title:
    {
      text: 'Interaction levels for the different items',
      x: -6
    },
    subtitle:
    {
      text: '',
      x: -20
    },
    xAxis: {
      title:
      {
        text: 'Time'
      },
      type: 'datetime',
      crosshair: true,
      maxPadding: 0,
      minPadding: 0,
    },
    yAxis:
    {
      min: 0,
      title:
      {
        text: 'Interaction Levels'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    legend:
    {
      title:
      {
        text: 'Items'
      },
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 100,
      borderWidth: 0
    }
  };

  $.ajax(
    {
      url: "getJSONInteraction.php",
      dataType: 'json',
      async: true,
      success: function (result) {
        var error = result['error'];

        if (error === 0) {
          chartInteraction = new Highcharts.Chart(options);

          $.each(result.data, function (index, element) {
            var dataArray = [];
            $.each(element, function (index2, element2) {
              var tempArray = [];

              tempArray.push(Date.UTC(element2[0], element2[1] - 1, element2[2], element2[3], element2[4], element2[5]));
              tempArray.push(element2[6]);

              dataArray.push(tempArray);
            });

            chartInteraction.addSeries({
              id: index,
              name: index,
              data: dataArray
            });
          });
          //$("#container").show();*/
        }
        else {
          //$("#container").hide();
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}

var interactionDate = new Date().toISOString().slice(0, 19).replace('T', ' ');

function updateInteractionData()
{
  console.log("update");
  $.ajax(
    {
      url: "getJSONInteraction.php",//?date=" + interactionDate,
      dataType: 'json',
      async: true,
      success: function (result) {
        var error = result['error'];

        if (error === 0) {
          $.each(result.data, function (index, element) {
            var dataArray = [];
            $.each(element, function (index2, element2) {
              var tempArray = [];

              tempArray.push(Date.UTC(element2[0], element2[1] - 1, element2[2], element2[3], element2[4], element2[5]));
              tempArray.push(element2[6]);

              dataArray.push(tempArray);
              /*
              series.addPoint(tempArray); */           
              
            });
            var series = chartInteraction.get(index);
            series.setData(dataArray);        
          });
          interactionDate = new Date().toISOString().slice(0, 19).replace('T', ' ');
        }
        else {
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}

