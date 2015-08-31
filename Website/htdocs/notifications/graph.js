function changeGraph(url) {
  var options = {
    chart:
    {
      renderTo: 'eventsChart',
      type: 'column'
    },
    credits:
    {
      enabled: false
    },
    title:
    {
      text: 'Amount',
      x: -6
    },
    subtitle:
    {
      text: '',
      x: -20
    },
    xAxis: {
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
        text: 'Amount'
      }
    },
    dataGrouping: {
      approximation: "sum",
      enabled: true,
      forced: true
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
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
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

  $.ajax(
    {
      url: "getGraphData.php" + url,
      dataType: 'json',
      async: true,
      success: function (result) {
        var error = result['error'];
        if (error === 0) {
          var chart = new Highcharts.StockChart(options);


          for (var i = 0; i < result['data'].length; i++) {
            var obj = result['data'][i];

            var dataArray = [];

            for (var j = 0; j < obj.data.length; j++) {
              var tempArray = [];

              tempArray.push(Date.UTC(obj.data[j][0], obj.data[j][1] - 1, obj.data[j][2], obj.data[j][3], obj.data[j][4], obj.data[j][5]));
              tempArray.push(obj.data[j][6]);

              dataArray.push(tempArray);
            }

            chart.addSeries({
              name: obj.name,
              data: dataArray
            });
          }
          $("#histroyChartPanel").show();
        }
        else {
          $("#histroyChartPanel").hide();
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}

