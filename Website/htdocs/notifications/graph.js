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
                type: 'datetime',
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
                  formatter: function() {
                          return '<b>'+ this.series.name +'</b><br/>'+
                          this.x +': '+ this.y;
                  }
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
