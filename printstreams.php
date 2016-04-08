<?php
/*
*	@author: Jamey Ballard
*	@date: 4/8/2016
*	@filename: printstreams.php
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top'), true);
echo "<div id=\"leftpanel\">";
echo "<center>"."<font face=\"arial\" size=\"6\"><b>"."Current Top Games on Twitch"."</b></font>"."<br>";

echo "<font face=\"arial\" size =\"4\">";

for ($i=0; $i <10 ; $i++) {
  echo "<br>" . $dataArray['top'][$i]['game']['name'] ."</br>";
  //echo "<img src=" .$dataArray['top'][$i]['game']['logo']['large']. ">";
  
}
echo "</font>"."</center>"."</div>";
 ?>
