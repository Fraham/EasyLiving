/*var chart;
$(document).ready(function() {
  var cursan = {
    chart: {
      renderTo: 'events',
      //defaultSeriesType: 'area',
      //type: 'bubble',
      marginRight: 10,
      marginBottom: 20
    },
    title: {
      text: '',
    },
    xAxis: {
      type: 'datetime',
      gridLineWidth: 1,
    },
    yAxis: {
      title: {
        text: 'Count'
      },
      plotLines: [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip: {
      crosshairs: true,
      shared: true
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -10,
      y: 30,
      borderWidth: 0
    },

    plotOptions: {

      series: {
        cursor: 'pointer',
        marker: {
          lineWidth: 1
        }
      }
    },

    series: [{
      name: 'Test Colomn'
    }]
  }

  var property = $("propertySelect").text();

  //Fetch MySql Records
  jQuery.get('getGraphData.php', null, function(tsv)
  {
    var lines = [];
    traffic = [];

    try
    {
      // split the data return into lines and parse them
      tsv = tsv.split(/\n/g);

      jQuery.each(tsv, function(i, line)
      {
        line = line.split(/\t/);
        date = line[0] ;

        amo = parseFloat(line[1].replace(',', ''));

        if (isNaN(amo))
        {
          amo = null;
        }

        traffic.push([
          date,
          amo
        ]);
      });
    }
    catch (e)
    {  }

    cursan.series[0].data = traffic;
    chart = new Highcharts.Chart(cursan);
  });
});*/
/*
$(function () {
    var chart;
    $(document).ready(function() {
        $.getJSON("getGraphData.php", function(json) {

        chart = new Highcharts.Chart({
              chart: {
                  renderTo: 'events',
                  type: 'line'
              },
              title: {
                  text: 'Amount',
                  x: -6 //center
              },
              subtitle: {
                  text: '',
                  x: -20
              },
              xAxis: {
                type: 'datetime'
              },
              yAxis: {
                  title: {
                      text: 'Amount'
                  },
                  plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                  }]
              },
              tooltip: {
                crosshairs: true,
                shared: true
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'top',
                  x: -10,
                  y: 100,
                  borderWidth: 0
              },
              series: json
          });
      });

    });

});
*/

function changeGraph(url)
{  
  var options = {
              chart: {
                  renderTo: 'events',
                  type: 'line'
              },
              title: {
                  text: 'Amount',
                  x: -6 //center
              },
              subtitle: {
                  text: '',
                  x: -20
              },
              xAxis: {
                type: 'datetime',
				pointStart: Date.UTC(2015, 3, 4, 9, 30),
				pointInterval: 30 *60 * 1000,
				labels: {
					formatter: function() {
						return Highcharts.dateFormat('%I:%M %P', this.value);
					}
				},
				dateTimeLabelFormats: { day:'%Y-%m-%d' },
				title: {
					text: 'Date',
					align: 'high'
				}
              },
              yAxis: {
                  title: {
                      text: 'Amount'
                  },
                  plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                  }]
              },
              tooltip: {
                crosshairs: true,
                shared: true
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'top',
                  x: -10,
                  y: 100,
                  borderWidth: 0
              }
          };
  
  $.getJSON("getGraphData.php" + url, function(json) {
    for (var i = 0; i < json.length; i++ ){ 
      json[i][1] = new Date(json[i][1]).getTime();
    }

        options.series = json;
        
    var chart = new Highcharts.Chart(options);
        
      });
}