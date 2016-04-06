<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top'), true);

echo "Top games now on twitch";

for ($i=0; $i <10 ; $i++) {
  echo "<br>" . $dataArray['top'][$i]['game']['name'] ."</br>";
}






 ?>
