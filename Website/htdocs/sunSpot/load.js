function load() {
  var options = {
    chart:
    {
      renderTo: 'container',
      type: 'line'
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
      '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    legend:
    {
      title:
      {
        text: 'Zones'
      },
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
      url: "getJSON.php",
      dataType: 'json',
      async: true,
      success: function (result) {
        var error = result['error'];

        if (error === 0) {
          var chart = new Highcharts.Chart(options);

          $.each(result.data, function (index, element) {
            var dataArray = [];
            $.each(element, function (index2, element2) {
              var tempArray = [];

              tempArray.push(Date.UTC(element2[0], element2[1] - 1, element2[2], element2[3], element2[4], element2[5]));
              tempArray.push(element2[6]);

              dataArray.push(tempArray);
            });

            chart.addSeries({
              name: index,
              data: dataArray
            });
          });
          //$("#container").show();*/
        }
        else {
          //$("#container").hide();
        }
      },
      error: function (e) {
        console.log(e);
      },
      complete: function () {

      }
    });
}

