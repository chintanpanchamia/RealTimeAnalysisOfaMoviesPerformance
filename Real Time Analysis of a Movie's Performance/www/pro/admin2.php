<?php
  $url = "/home/parthrparekh93/project/repository/";
  $url2 = "/home/parthrparekh93/project/movies/";
  if(isset($_GET["hashforweek"]))
  {
    $hashforweek = $_GET["hashforweek"];
    if(!empty($hashforweek))
    {
      $myfile1 = fopen($url."movie_input.txt", "a") or die("Unable to open result file!");
      fwrite($myfile1,$hashforweek."\n");
      fclose($myfile1);
      $movie_list_array = explode(' ',$hashforweek);
      for ($x = 0; $x < count($movie_list_array); $x++)
      {
        if (is_dir($url2.$movie_list_array[$x]))
        {
          //nothing to be done here as the directory exists
        }
        else
        {
          mkdir($url2.$movie_list_array[$x], 0777, true);
          $newfile1 = fopen($url2.$movie_list_array[$x]."/".$movie_list_array[$x]."_full.txt","a");
          fclose($newfile1);
          $newfile1 = fopen($url2.$movie_list_array[$x]."/".$movie_list_array[$x].".txt","a");
          fclose($newfile1);
          $newfile1 = fopen($url2.$movie_list_array[$x]."/".$movie_list_array[$x]."_full_with_senti.txt","a");
          fclose($newfile1);
          $newfile1 = fopen($url2.$movie_list_array[$x]."/".$movie_list_array[$x]."_geo.txt","a");
          fclose($newfile1);
          $newfile1 = fopen($url2.$movie_list_array[$x]."/".$movie_list_array[$x]."_pos_neg.txt","a");
          fclose($newfile1);
        }
      }
    }
  } 
  else
  {
    echo "Please fill in the details";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <h2>Input Hashtags for a week</h2>
      <form role="form" action ="#" method = "GET">
        <div class="form-group">
          <input type="text" class="form-control" id="hashforweek" name = "hashforweek" placeholder="#abc #xyz #123">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>