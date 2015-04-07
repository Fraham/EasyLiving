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

/*$(function () {
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

});*/


$(document).ready(function() {

    var options = {
        chart: {
            renderTo: 'linechart',
            type: 'line'
        },
        title: {
            text: 'Title for '
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                month: '%b %e, %Y',
                year: '%Y'
            }
        },
        yAxis: {
            title: {
                text: 'Important Values'
            },
            reversed: true,
            min: 0,
            max: 100
        },
        tooltip: {
        },
        series: []

    };

    $.get('getGraphData.php?',function(data) {
        $.each(data, function(key,value) {
            var series = { data: []};
            $.each(value, function(key,val) {
                if (key == 'name') {
                    series.name = val;
                }
                else
                {
                    $.each(val, function(key,val) {
                        var d = val.split(",");
                        var x = Date.UTC(d[0],d[1],d[2]);
                        series.data.push([x,d[3]]);
                    });
                }
            });
            options.series.push(series);
        });

        var linechart = new Highcharts.Chart(options);
    });

});
