var chart;
var chartH;

function changeTemperatureGraph(url) {
  var options = {
    chart:
    {
      renderTo: 'temperatureChart',
      type: 'line'
    },
    credits:
    {
      enabled: false
    },
    title:
    {
      text: 'Temperature',
      x: -6
    },
    subtitle:
    {
      text: '',
      x: -20
    },
    xAxis: {
      type: 'datetime',
      maxPadding: 0,
      minPadding: 0,
    },
    yAxis:
    {
      title:
      {
        text: 'Degrees'
      },
      plotLines:
      [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip:
    {
      crosshairs: true,
      shared: true
    },
    legend:
    {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 100,
      borderWidth: 0
    }
  };

  var optionsH = {
    chart:
    {
      renderTo: 'humidityChart',
      type: 'line'
    },
    credits:
    {
      enabled: false
    },
    title:
    {
      text: 'Humidity',
      x: -6
    },
    subtitle:
    {
      text: '',
      x: -20
    },
    xAxis: {
      type: 'datetime',
      maxPadding: 0,
      minPadding: 0,
    },
    yAxis:
    {
      title:
      {
        text: 'Percentage'
      },
      plotLines:
      [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip:
    {
      crosshairs: true,
      shared: true
    },
    legend:
    {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 100,
      borderWidth: 0
    }
  };

  chart = new Highcharts.Chart(options);
  chartH = new Highcharts.Chart(optionsH);

  $.getJSON("getTemperatureGraphData.php" + url, function (json) {

    var tempHigh = -99;
    var tempLow = 1000;

    var count = 0;
    var totalTemp = 0;
    var averageTemp = 0;

    for (var i = 0; i < json.length; i++) {
      var obj = json[i];

      var temperatureDataArray = [];
      var humidityDataArray = [];



      for (var j = 0; j < obj.data.length; j++) {
        var tempArray = [];
        var tempArrayH = [];
        var date = Date.UTC(obj.data[j][0], obj.data[j][1] - 1, obj.data[j][2], obj.data[j][3], obj.data[j][4], obj.data[j][5]);

        count++;

        if (obj.data[j][6] != null) {
          var temp = obj.data[j][6];

          tempArray.push(date);
          tempArray.push(temp);

          if (temp > tempHigh) {
            tempHigh = temp;
          }
          if (temp > tempLow) {
            tempLow = temp;
          }

          totalTemp += temp;

          temperatureDataArray.push(tempArray);
        }

        if (obj.data[j][7] != null) {
          tempArrayH.push(date);
          tempArrayH.push(obj.data[j][7]);

          humidityDataArray.push(tempArrayH);
        }
      }

      chart.addSeries({
        name: obj.name,
        data: temperatureDataArray
      });

      chartH.addSeries({
        name: obj.name,
        data: humidityDataArray
      });
    }
    averageTemp = totalTemp / count;

    console.log(averageTemp);
  });
}

