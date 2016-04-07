<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top'), true);

echo "<center>"."<font face=\"arial\" size=\"6\"><b>"."Current Top Games on Twitch"."</b></font>"."<br>";

echo "<font face=\"arial\" size =\"4\">";

for ($i=0; $i <10 ; $i++) {
  echo "<br>" . $dataArray['top'][$i]['game']['name'] ."</br>";
}
echo "</font>"."</center>";
 ?>
