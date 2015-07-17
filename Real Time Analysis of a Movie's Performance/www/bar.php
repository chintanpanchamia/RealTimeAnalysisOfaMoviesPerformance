<?php
    $tweet_array = array(100,50,200,59,20);
?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sentiment');
        data.addColumn('number', 'Tweets');
        data.addRows([
          ['Extremely Positive', <?php echo intval($tweet_array[0]); ?>],
          ['Positive', <?php echo intval($tweet_array[1]); ?>],
          ['Neutral', <?php echo intval($tweet_array[2]); ?>],
          ['Negative', <?php echo intval($tweet_array[3]); ?>],
          ['Extremely Negative', <?php echo intval($tweet_array[4]); ?>]
        ]);

        // Set chart options
        var options = {'title':'Singham',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
