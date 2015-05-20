function changeGraph(url)
{  
  var options = {
              chart: 
              {
                  renderTo: 'events',
                  type: 'spline'
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
                maxPadding: 0,
				        minPadding: 0,
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

