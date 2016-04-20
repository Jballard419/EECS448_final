<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top?limit=50'), true);





echo "<form action= ' random_backend.php' method='post'>";




echo "choose a game";

echo "<select name='game'>";


for ($i=0; $i <50 ; $i++) {

  $game_name= $dataArray['top'][$i]['game']['name'];
   echo " <option value=' . $game_name .' >" . $dataArray['top'][$i]['game']['name'] . "</option>";

}







echo "</select> <br>";
echo " min views<input type='number'  name='minviews'  min='0' checked>" ;
echo "<br> max views<input type='number'  name='maxviews'  min='0' checked> </br>" ;

echo "<br> <input type= 'submit' value='Find random online stream'> </br>";

echo "</form>";


?>
