<?php
  $url = '/home/parthrparekh93/project/movies/';
  $url_json_geo = '/var/www/json_geo.py';
  $env_var = 'NH10';
  $myfile0 = fopen($url.'#'.$env_var.'/#'.$env_var.'_info.txt', 'r') or die('Unable to open info file!');
  $actors = trim(fgets($myfile0));
  $movie_name = fgets($myfile0);
  $movie_name = trim($movie_name);
  $fest = fgets($myfile0);
  if(trim($fest) == 'No'){$festival = 0;}
  else{$festival = 1;}
  $eve = fgets($myfile0);
  if(trim($eve) == 'No'){$event = 0;}
  else{$event = 1;}
  $image_movie = trim(fgets($myfile0));
  $description = trim(fgets($myfile0));
  $release_date = trim(fgets($myfile0));
  $hashtag = fgets($myfile0);
  $hashtag = trim(substr($hashtag,1));
  $json_file = $hashtag.'.json';
  fclose($myfile0);
  $image_prediction_superhit = 'superhit.jpeg';
  $image_prediction_hit = 'hit.jpg';
  $image_prediction_flop = 'flop.jpg';
  $image_prediction_average = 'average.png';
  $tweet_array = array(0,0,0,0,0);
  $success_value = 0;
  $command = escapeshellcmd('python '.$url_json_geo.' '.$hashtag);
  $output = shell_exec($command);
  //echo $url."#".$hashtag."/#".$hashtag."_prediction.txt";
  $myfile1 = fopen($url.'#'.$hashtag.'/#'.$hashtag.'_prediction.txt', 'r') or die('Unable to open result file!');
  $success_value = fgets($myfile1) + ($festival*0.4) - ($event*0.3);
  //echo $success_value;
  fclose($myfile1);
  $myfile = fopen($url.'#'.$hashtag.'/#'.$hashtag.'_pos_neg.txt', 'r') or die('Unable to open file!');
  // Output one line until end-of-file
  while(!feof($myfile)) {
    $line =  fgets($myfile) . '<br>';
    $tweet_array_temp = explode(' ',$line);
    $tweet_array[0] = $tweet_array[0] + $tweet_array_temp[0];
    $tweet_array[1] = $tweet_array[1] + $tweet_array_temp[1]; 
    $tweet_array[2] = $tweet_array[2] + $tweet_array_temp[2];
    $tweet_array[3] = $tweet_array[3] + $tweet_array_temp[3];
    $tweet_array[4] = $tweet_array[4] + $tweet_array_temp[4];
  }
  fclose($myfile);

  $positive_percent = ($tweet_array[0]*2 + $tweet_array[1])/($tweet_array[0]*2 + $tweet_array[1] + $tweet_array[2] + $tweet_array[3] + $tweet_array[4]*2);
  if ($positive_percent > 0.5)
  {
    $success_value = $success_value + ($positive_percent - 0.5)*2.75;
  }
  else
  {
    $success_value = $success_value - (0.5 - $positive_percent)*2.75;
  }
  //echo $success_value; 
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $movie_name; ?></title>

    <!-- Bootstrap -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->

    <script type='text/javascript' src='js/bar_graph.js'></script>
    <script type='text/javascript'>

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
          ['Negative', <?php echo intval($tweet_array[3]); ?>],
          ['Extremely Negative', <?php echo intval($tweet_array[4]); ?>]
        ]);

        // Set chart options
        var options = {'title':'<?php echo $movie_name; ?>',
                       'width':300,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <!-- Map of India-->
    <link rel='stylesheet' type='text/css' href='../pykcharts.1.0.0.min.css'>
    <script src='../pykcharts.1.0.0.min.js'></script>      

  </head>
  <body>


    <div class='navbar-wrapper'>
      <div class='container'>

        <nav class='navbar navbar-inverse navbar-static-top'>
          <div class='container'>
            <div class='navbar-header'>
              <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
              </button>
              <a class='navbar-brand' href='#'>Real-Time Analysis of Movie's Performance</a>
            </div>
            <div id='navbar' class='navbar-collapse collapse'>
              <ul class='nav navbar-nav'>
                <li class='active'><a href='test.php'>Home</a></li>
                <li><a href='contact.html'>Contact Us</a></li>
                <!--<li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Dropdown <span class='caret'></span></a>
                  <ul class='dropdown-menu' role='menu'>
                    <li><a href='#'>Action</a></li>
                    <li><a href='#'>Another action</a></li>
                    <li><a href='#'>Something else here</a></li>
                    <li class='divider'></li>
                    <li class='dropdown-header'>Nav header</li>
                    <li><a href='#'>Separated link</a></li>
                    <li><a href='#'>One more separated link</a></li>
                  </ul>
                </li>-->
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
    
    <hr class='featurette-divider'>

      <div class='row featurette'>
        <div class='col-md-7 col-md-push-5'>
          <h2 class='featurette-heading'><?php echo $movie_name;?></h2>
          <p class='lead'><?php echo $actors; ?></p>
          <p class='lead'><?php echo $description; ?></p>
        </div>
        <div class='col-md-5 col-md-pull-7'>
          <img class='featurette-image img-responsive center-block' data-src='holder.js/500x500/auto' src = '<?php echo $image_movie;?>' alt='Generic placeholder image'>
        </div>
      </div>


      <!-- Holds the graph and map -->
      <div class='container'>
        <div class='row'>
          <div class='col-sm-4'>
            <div id='chart_div'></div>
          </div>
          <div class='col-sm-3 other'>
            <div id = 'prediction'>
              <img src = '<?php if($success_value >=0 && $success_value < 1.5) {echo $image_prediction_flop;} elseif ($success_value >=1.5 && $success_value < 2.5) {echo $image_prediction_average;} elseif ($success_value >=2.5 && $success_value < 3.5) {echo $image_prediction_hit;} elseif ($success_value >= 3.5) {echo $image_prediction_superhit;} ?>' alt = 'Net problem'>
            </div> 
          </div>
          <div class='col-sm-5 other'>
            <div id='my_chart'></div>
          </div>
        </div>
      </div>

      <script>
      window.PykChartsInit = function (e) {
      var k = new PykCharts.maps.oneLayer({
        selector: '#my_chart',
        data: '../<?php echo $json_file;?>',
        map_code: 'india',

        // optional
        chart_height: 500
        });
        k.execute();
      }
      </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src='js/jQuery_help.js'></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='js/bootstrap.min.js'></script>
  </body>
</html>