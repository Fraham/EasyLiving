<?php
	?>
	<head>
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>

		<script src="load.js"></script>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
	</head>
	<body>
		<button onclick="graphChange(1)">Zone 1</button> 
		<button onclick="graphChange(2)">Zone 2</button> 
		<button onclick="graphChange(3)">Zone 3</button> 
		<div id="temperatureGraph" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div id="lightGraph" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<script>
			loadTemperature();
			loadLight();
		</script>
	</body>