<?php
/*
* @author Jamey Ballard
* @file extension_random.php
* @about handles the backend of the extension to take them to random stream uses get conditions instead of post conditions and redirects url,
* @date 2016/05/06
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);

$game = $_GET["game"];
$game=urlencode($game);
$minviews=$_GET["minviews"];
$maxviews=$_GET["maxviews"];
$game=trim($game, "+.");
$language=$_POST["language"];
$unleash= "https://api.twitch.tv/kraken/streams?stream_type=live&language=" . $language . "&limit=1&game=" . $game ."";
$random_stream= json_decode(@file_get_contents($unleash), true);;
$maxindex= $random_stream["_total"]-1;

/*
* @param $game is a string that comes from the form, $max_or_min is a string that is the amount of views we're looking for
* @pre take in the number of views and the game you want, from the extension
* @post sort through  array of streams with those views
* @return $fin_index when you find a stream with the amount of view less than max_or_min, else return $total, all the streams
*/
function find_view($max_or_min, $game)
{
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
             return $fin_index; // TODO: get this method to work faster
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

$rand_num = mt_rand($minindex, $maxindex);

$unleash= "https://api.twitch.tv/kraken/streams?stream_type=live&language=" . $language . "&offset=" . $rand_num . "&limit=100&game=" . $game ."";

$random_stream= json_decode(@file_get_contents($unleash), true);;

$name=$random_stream['streams'][0]['channel']['name'];

$url_twitch=$random_stream['streams'][0]['channel']['url'];

$url_US =str_replace("random_backend.php","index.html?channel_name=". $name,$url);

header('Location: '.$url_twitch); //redircet to our random Url

die();
?>
