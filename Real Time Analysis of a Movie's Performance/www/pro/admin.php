<?php
  $url = "/home/parthrparekh93/project/movies/";
  $runid3_file = "/home/parthrparekh93/project/tweepy/runid3.py";
  if(isset($_GET["moviename"]) && isset($_GET["artists"]) && isset($_GET["release"]) && isset($_GET["description"]) && isset($_GET["image"]) && isset($_GET["hashtag"]))
  {
    $moviename = $_GET["moviename"];
    $artists = $_GET["artists"];
    $release = $_GET["release"];
    $description = $_GET["description"];
    $image = $_GET["image"];
    $hashtag = $_GET["hashtag"];
    if($_GET["festival"] == "on"){$festival = Yes;}else{$festival = No;}
    if($_GET["events"] == "on"){$events = Yes;}else{$events = No;}
    if(!empty($moviename) && !empty($artists) && !empty($release) && !empty($description) && !empty($image) && !empty($hashtag))
    {
      $myfile1 = fopen($url.$hashtag."/".$hashtag."_info.txt", "w") or die("Unable to open result file!");
      fwrite($myfile1,$artists."\n");
      fwrite($myfile1,$moviename."\n");
      fwrite($myfile1,$festival."\n");
      fwrite($myfile1,$events."\n");
      fwrite($myfile1,$image."\n");
      fwrite($myfile1,$description."\n");
      fwrite($myfile1,$release."\n");
      fwrite($myfile1,$hashtag."\n");
      fclose($myfile1);
      $command = escapeshellcmd('python '.$runid3_file.' '.substr($hashtag,1));
      $output = shell_exec($command);
    }
  } 
  else
  {
    echo "Please fill in all the details";
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
      <h2>Add Movie Details</h2>
      <form role="form" action ="#" method = "GET">
        <div class="form-group">
          <label for="moviename">Moviename:</label>
          <input type="text" class="form-control" id="moviename" name = "moviename" placeholder="Enter Moviename">
        </div>
        <div class="form-group">
          <label for="artists">Artists:</label>
          <input type="text" class="form-control" id="artists" name = "artists" placeholder="Actor1,Actor2,Actor3,Actor4,Director,Producer,Music Composer">
        </div>
        <div class="form-group">
          <label for="release">Release Date:</label>
          <input type="text" class="form-control" id="release" name = "release" placeholder="Enter Release Date(dd/mm/yyyy)">
        </div>
        <div class="checkbox">
          <label><input type="checkbox" id= "festival" name = "festival">Festival Release</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" id= "events" name = "events">International Events</label>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="description" name = "description" placeholder="Enter Description">
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="text" class="form-control" id="image" name = "image" placeholder="Enter image stored">
        </div>
        <div class="form-group">
          <label for="hashtag">Hashtag</label>
          <input type="text" class="form-control" id="hashtag" name = "hashtag" placeholder="Enter official hashtag">
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