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
    rangeSelector: {
      enabled: true,
      buttons: [{
        type: 'day',
        count: 3,
        text: '3d'
      }, {
          type: 'week',
          count: 1,
          text: '1w'
        }, {
          type: 'month',
          count: 1,
          text: '1m'
        }, {
          type: 'month',
          count: 6,
          text: '6m'
        }, {
          type: 'year',
          count: 1,
          text: '1y'
        }, {
          type: 'all',
          text: 'All'
        }],
      selected: 3
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
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
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
    rangeSelector: {
      enabled: true,
      buttons: [{
        type: 'day',
        count: 3,
        text: '3d'
      }, {
          type: 'week',
          count: 1,
          text: '1w'
        }, {
          type: 'month',
          count: 1,
          text: '1m'
        }, {
          type: 'month',
          count: 6,
          text: '6m'
        }, {
          type: 'year',
          count: 1,
          text: '1y'
        }, {
          type: 'all',
          text: 'All'
        }],
      selected: 3
    },
    tooltip:
    {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
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

  chart = new Highcharts.StockChart(options);
  chartH = new Highcharts.StockChart(optionsH);

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
          humCount++;
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


      if (tempCount > 0) {
        chart.addSeries({
          name: obj.name,
          data: temperatureDataArray
        });


        averageTemp = totalTemp / tempCount;

        $("#highestTemp").text(tempHigh.toFixed(2));
        $("#lowestTemp").text(tempLow.toFixed(2));
        $("#averageTemp").text(averageTemp.toFixed(2));

        $("#temperaturePanelSize").show();
      }
      else {
        $("#temperaturePanelSize").hide();
      }
      if (humCount > 0) {
        chartH.addSeries({
          name: obj.name,
          data: humidityDataArray
        });

        averageHum = totalHum / humCount;

        $("#highestHum").text(humHigh.toFixed(2));
        $("#lowestHum").text(humLow.toFixed(2));
        $("#averageHum").text(averageHum.toFixed(2));

        $("#humidityPanelSize").show();
      }
      else {
        $("#humidityPanelSize").hide();
      }
    }
  });
}

