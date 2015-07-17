<?php
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="pykcharts.1.0.0.min.css">
    <script src="pykcharts.1.0.0.min.js"></script>
</head>
<body>
    <div id="my_chart"></div>
    <script>
    window.PykChartsInit = function (e) {
    var k = new PykCharts.maps.oneLayer({
      selector: "#my_chart",
      data: "world_data.json",
      map_code: "india",

      // optional
      chart_height: 500
    });
    k.execute();
    }
    </script>
</body>
</html>
