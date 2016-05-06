<?php
/*
*	@author: Jamey Ballard
*	@date:	4/8/2016
*	@filename: random_backend.php
*	@about called from HTML  and gets a random stream from people that the entred username is following
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$game = $_POST["game"];
$game=urlencode($game);
$minviews=$_POST["minviews"];
$maxviews=$_POST["maxviews"];
$game=trim($game, "+.");
$language=$_POST["language"];
$unleash= "https://api.twitch.tv/kraken/streams?stream_type=live&language=" . $language . "&limit=1&game=" . $game ."";
$random_stream= json_decode(@file_get_contents($unleash), true);;
$maxindex= $random_stream["_total"]-1;

/*
* @param $game is a string that comes from the form, $max_or_min is a string that is the amount of views we're looking for
* @pre take in the number of views and the game you want from the HTML
* @post sort through  array of streams with those views
* @return $fin_index when you find a stream with the amount of view less than max_or_min, else return $total, all the streams
*/
function find_view($max_or_min, $game) {
  # code...
  $n=0;
  $fin_index=0;

  do
  {
    $unleash= "https://api.twitch.tv/kraken/streams?stream_type=live&language=" . $GLOBALS['language']  . "&offset=" . $n . "&limit=100&game=" . $game .""; // builds the call we are going to make to the API
    $streamArray= json_decode(@file_get_contents($unleash), true);;
    $total = $streamArray["_total"];
    $q=count($streamArray["streams"])-1;

    if($streamArray["streams"][$q]["viewers"]<$max_or_min)
    {
      for ($i=0; $i <$q ; $i++)
      {
           if($streamArray["streams"][$i]["viewers"]<$max_or_min)
           {
             return $fin_index; // get this method to work faster
           }else
           {
             $fin_index++;
           }
      }
    }else
    {
      $fin_index=$fin_index+100;
    }

    $n=$n+100;
    }while (($total-$n)>0);

return $total;
}

if(ctype_digit($maxviews))
{
  $minindex = find_view($maxviews, $game) ;
}
else
{
    $minindex= 0;
}

if(ctype_digit($minviews)&&$minviews>0)
{
  $maxindex = find_view($minviews, $game) -1;
}

if ($maxindex <0||$minindex> $maxindex)
{
  echo $minviews . "<br>". $maxviews;
  echo "no streams with selected value"; // get this to just show on web page
  return;
}

if(!isset($_POST['dim']))
{
  echo "string";
  $rand_num = mt_rand($minindex, $maxindex);

  $unleash= "https://api.twitch.tv/kraken/streams?stream_type=live&language=" . $language . "&offset=" . $rand_num . "&limit=100&game=" . $game ."";

  $random_stream= json_decode(@file_get_contents($unleash), true);;

  $name=$random_stream['streams'][0]['channel']['name'];
  $url_twitch=$random_stream['streams'][0]['channel']['url'];

  $url_US =str_replace("random_backend.php","index.html?channel_name=". $name,$url);

  header('Location: '.$url_US); //redircet to our random Url
  die();
}

$stream_name = array();

for ($i=0; $i <4 ; $i++)
{
  $rand_num = mt_rand($minindex, $maxindex);
  $unleash= "https://api.twitch.tv/kraken/streams?stream_type=live&language=" . $language . "&offset=" . $rand_num . "&limit=100&game=" . $game ."";
  $random_stream= json_decode(@file_get_contents($unleash), true);;
  $stream_name[$i]=$random_stream['streams'][0]['channel']['name'];
}

$url_US =str_replace("random_backend.php","three.js-master/examples/css3d_youtube.html?".implode(",",$stream_name) ,$url);
header('Location: '.$url_US); //redircet to our random Url
die();
 ?>
