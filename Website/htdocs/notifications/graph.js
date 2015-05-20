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
              chart: 
              {
                  renderTo: 'events',
                  //type: 'line'
                  type: 'spline'
              },
              credits: 
              {
                enabled: false
              },
              title: 
              {
                  text: 'Amount',
                  x: -6 //center
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
                /*dateTimeLabelFormats: 
                {
                    millisecond: '%H:%M:%S',
                    second: '%H:%M:%S',
                    minute: '%H:%M',
                    hour: '%H:%M'
				        }*/
			        },
              yAxis: 
              {
                  title: 
                  {
                      text: 'Amount'
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
  
  $.getJSON("getGraphData.php" + url, function(json) 
  {
    /*for (var i = 0; i < json.length; i++ )
    { 
      json[i][0] = new Date(json[i][0]).getTime();
    }
    
    options.series = json;   */
    

    
    var chart = new Highcharts.Chart(options);
    
    for(var i = 0; i < json.length; i++) 
    {
      var obj = json[i];
      
      var dataArray = [];
      
      for(var j = 0; j < obj.data.length; j++) 
      {
        console.log(obj.data[j]);
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

/*

$(function () {
	var chart, options, rawRealtime, interval,
		// countdown timer, 60 secs/1 min
		count = 60,

		// location of the realtime.txt file
		realtimeFile = './realtime.txt',

		// The various delimiters used in your version of realtime.txt
		dateDelimiter = '/',
		timeDelimiter = ':',

		// 120 = 2 hours at 1 minute per data point
		numDisplayRecs = 120,

		// Fields of realtime.txt file
		// Use the same names as the corresponding web tags
		fields = {
			date: 0, time: 1, temp: 2, hum: 3, dew: 4, wspeed: 5, wlatest: 6, bearing: 7, rrate: 8, rfall: 9,
			press: 10, currentwdir: 11, beaufortnumber: 12, windunit: 13, tempunitnodeg: 14, pressunit: 15,
			rainunit: 16, windrun: 17, presstrendval: 18, rmonth: 19, ryear: 20, rfallY: 21, intemp: 22,
			inhum: 23, wchill: 24, temptrend: 25, tempTH: 26, TtempTH: 27, tempTL: 28, TtempTL: 29, windTM: 30,
			TwindTM: 31, wgustTM: 32, TwgustTM: 33, pressTH: 34, TpressTH: 35, pressTL: 36, TpressTL: 37,
			version: 38, build: 39, wgust: 40, heatindex: 41, humidex: 42, UV: 43, ET: 44, SolarRad: 45,
			avgbearing: 46, rhour: 47, forecastnumber: 48, isdaylight: 49, SensorContactLost: 50, wdir: 51,
			cloudbasevalue: 52, cloudbaseunit: 53, apptemp: 54, SunshineHours: 55, CurrentSolarMax: 56, IsSunny: 57
		},

		// Fetch the realtime.txt file
		getRealtime = function () {
			$.ajax({
				url: realtimeFile,
				datatype: 'text',
				success: function (data) { parseRealtime(data); },
				cache: false
			});
		},

		// Extract the fields from realtime.txt and update graph
		parseRealtime = function (data) {
			var tim,
				shift = chart.series[0].data.length < numDisplayRecs ? false : true;

			rawRealtime = data.split(' ');
			tim = getDate(rawRealtime[0], rawRealtime[1]);
			chart.series[0].addPoint([tim, +getRealtimeValue('rfall')], false, shift);
			chart.series[1].addPoint([tim, +getRealtimeValue('press')], false, shift);
			chart.series[2].addPoint([tim, +getRealtimeValue('wspeed')], false, shift);
			chart.series[3].addPoint([tim, +getRealtimeValue('temp')], false, shift);
			chart.redraw();
		},

		// Returns the value from realtime.txt given the field name
		getRealtimeValue = function (field) {
			return rawRealtime[fields[field]];
		},

		// Returns a UTC date value from date & time strings
		getDate = function (strDate, strTime) {
			var d = strDate.split(dateDelimiter),
				t = strTime.split(timeDelimiter);
			return Date.UTC('20' + d[2], +d[1] - 1, d[0], t[0], t[1], t[2]);
		};


    $(document).ready(function () {
        // define the chart options
        options = {
            chart: {
                renderTo: 'container'
            },

            credits: {
                enabled: false
            },

            title: {
                text: 'Near Realtime Data',
				y: 10,
				margin: 20
            },

            subtitle: {
                text: null
            },

            xAxis: {
                type: 'datetime',
                maxPadding: 0,
				minPadding: 0,
                dateTimeLabelFormats: {
                    millisecond: '%H:%M:%S',
                    second: '%H:%M:%S',
                    minute: '%H:%M',
                    hour: '%H:%M'
				}
			},

            yAxis: [
				{ // left y axis 0
					title: { text: 'wind speed (mph)' },
					min: 0,
					minRange: 4
				}, { // right y axis 1
					title: { text: 'temerature (°C)' },
					opposite: true,
					minRange: 1
				}, { // right y axis 2
					title: { text: 'pressure (hPa)' },
					opposite: true,
					minRange: 1,
					labels: {
						formatter: function () {
							return this.value.toFixed(1);
						}
					}
				}, { // left y axis 3
					title: { text: 'rainfall (mm)' },
					min: 0,
					minRange: 1
				}
			],

            legend: {
                align: 'left',
                verticalAlign: 'top',
                y: 5,
                floating: true,
                borderWidth: 0
            },

            plotOptions: {
                series: {
                    cursor: 'pointer',
                    marker: { enabled: false }
                }
            },

            series: [
				{
					name: 'Rainfall',
					type: 'area',
					data: [],
					yAxis: 3,
					tooltip: { valueSuffix: ' mm' },
					color: 'rgba(100,200,255,0.8)',
					fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, 'rgba(10,100,255,0.3)'],
                            [1, 'rgba(2,0,0,0)']
                        ]
					}
                }, {
					name: 'Pressure',
					type: 'spline',
					data: [],
					yAxis: 2,
					tooltip: { valueSuffix: ' hPa' }
                }, {
					name: 'Latest wind',
					type: 'spline',
					data: [],
					yAxis: 0,
					tooltip: { valueSuffix: ' mph' }
                }, {
					name: 'Temperature',
					type: 'spline',
					data: [],
					yAxis: 1,
					tooltip: { valueSuffix: ' °C' }
                }
            ]
        }; // end options{}

		// Fetch the 'historic' realtime data from the server using a PHP call
        $.ajax({
			// Use the 'webtag' names of the fields to pull back
            url: './realtimeLogParser.php?count=' + numDisplayRecs + '&rfall&press&wspeed&temp',
            datatype: "json",
            success: function (resp) {
				// pre-load the log data
                options.series[0].data = resp.rfall;
                options.series[1].data = resp.press;
                options.series[2].data = resp.wspeed;
                options.series[3].data = resp.temp;
				// draw the chart
                chart = new Highcharts.Chart(options);
            }
        }); // end ajax()

		// fetch some more data every count interval
		interval = setInterval(function () { getRealtime(); }, count * 1000);

    }); // end document ready()
});


*/