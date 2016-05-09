<?php
/*
*	@author: Jamey Ballard
*	@date: 4/8/2016
*	@filename: printstreams.php
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top'), true);  // grabs the games object top from the API
echo "<div id=\"leftpanel\">"; //Panels and stuff
echo "<center>"."<font face=\"arial\" size=\"6\"><b>"."Current Top Games on Twitch"."</b></font>"."<br>";

echo "<font face=\"arial\" size =\"4\">";
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
for ($i=0; $i <10 ; $i++) {


  $name = $dataArray['top'][$i]['game']['name'];

  //$nam=rawurlencode($name);
     $url_2 =str_replace("?", "&". urlencode($name),$url);
   $url_US =str_replace("index.html", "extension_random.php?game=". urlencode($name),$url_2);
   echo   "<a href=". $url_US . "> ";
  $img= "http://static-cdn.jtvnw.net/ttv-boxart/". rawurlencode($name) . "-140x196.jpg";

  echo "<img src=". $img . "> </a>"; // prints off the name of each of the first ten games in the object  which will be the top games

}
echo "</font>"."</center>"."</div>";
 ?>
