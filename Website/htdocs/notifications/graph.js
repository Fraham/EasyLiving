function changeGraph(url)
{
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
        tooltip: {
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

  $.getJSON("getGraphData.php" + url, function(json)
  {
    var chart = new Highcharts.Chart(options);

    for(var i = 0; i < json.length; i++)
    {
      var obj = json[i];

      var dataArray = [];

      for(var j = 0; j < obj.data.length; j++)
      {
        var tempArray = [];
        var date = Date.UTC(obj.data[j][0], obj.data[j][1] - 1, obj.data[j][2], obj.data[j][3], obj.data[j][4], obj.data[j][5]);

        tempArray.push(date);
        tempArray.push(obj.data[j][6]);

        dataArray.push(tempArray);
      }

      chart.addSeries({
                    name: obj.name,
                    data: dataArray
      });
    }
  });
}

