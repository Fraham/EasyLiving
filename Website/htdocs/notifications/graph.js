var chart;
$(document).ready(function() {
  var cursan = {
    chart: {
      renderTo: 'sales',
      defaultSeriesType: 'area',
      marginRight: 10,
      marginBottom: 20
    },
    /*title: {
      text: 'Highchart With Mysql',
    },
    subtitle: {
      text: 'www.spjoshis.blogspot.com',
    },*/
    xAxis: {
      type: 'datetime',
      minRange: 14 * 24 * 3600000 // fourteen days
    },
    yAxis: {
      title: {
        text: 'Average'
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
      color: Highcharts.getOptions().colors[2],
      name: 'Test Colomn',
      marker: {
        fillColor: '#FFFFFF',
        lineWidth: 3,
        lineColor: null // inherit from series
      },
      data: [
                0.8446, 0.8445, 0.8444, 0.8451,    0.8418, 0.8264,    0.8258, 0.8232,    0.8233, 0.8258],
      dataLabels: {
        enabled: true,
        rotation: 0,
        color: '#666666',
        align: 'top',
        x: -10,
        y: -10,
        style: {
          fontSize: '9px',
          fontFamily: 'Verdana, sans-serif',
          textShadow: '0 0 0px black'
        }
      }
    }],
  }

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

        amo=parseFloat(line[1].replace(',', ''));

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
});
