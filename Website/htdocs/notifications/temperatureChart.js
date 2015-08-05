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

    var tempCount = 0;
    var totalTemp = 0;
    var averageTemp = 0;

    var humHigh = -99;
    var humLow = 1000;

    var humCount = 0;
    var totalHum = 0;
    var averageHum = 0;

    for (var i = 0; i < json.length; i++) {
      var obj = json[i];

      var temperatureDataArray = [];
      var humidityDataArray = [];

      for (var j = 0; j < obj.data.length; j++) {
        var tempArray = [];
        var tempArrayH = [];
        var date = Date.UTC(obj.data[j][0], obj.data[j][1] - 1, obj.data[j][2], obj.data[j][3], obj.data[j][4], obj.data[j][5]);

        if (obj.data[j][6] != null) {
          tempCount++;
          var temp = obj.data[j][6];

          tempArray.push(date);
          tempArray.push(temp);

          if (temp > tempHigh) {
            tempHigh = temp;
          }
          if (temp < tempLow) {
            tempLow = temp;
          }

          totalTemp += temp;

          temperatureDataArray.push(tempArray);
        }

        if (obj.data[j][7] != null) {
          var hum = obj.data[j][7];

          tempArrayH.push(date);
          tempArrayH.push(obj.data[j][7]);

          if (hum > humHigh) {
            humHigh = hum;
          }
          if (hum < humLow) {
            humLow = hum;
          }

          totalHum += hum;

          humidityDataArray.push(tempArrayH);
        }
      }
      if (tempCount > 0)
      {
        chart.addSeries({
          name: obj.name,
          data: temperatureDataArray
        });

        averageTemp = totalTemp / tempCount;

        $("#highestTemp").text(tempHigh.toFixed(2));
        $("#lowestTemp").text(tempLow.toFixed(2));
        $("#averageTemp").text(averageTemp.toFixed(2));
      }
      else
      {
        $( "#temperaturePanelSize" ).remove();
      }
      if (humCount > 0)
      {
        chartH.addSeries({
          name: obj.name,
          data: humidityDataArray
        });

        averageHum = totalHum / humCount;

        $("#highestHum").text(humHigh.toFixed(2));
        $("#lowestHum").text(humLow.toFixed(2));
        $("#averageHum").text(averageHum.toFixed(2));
      }
      else
      {
        $("#humidityDataArrayPanelSize").remove();
      }
    }
  });
}

