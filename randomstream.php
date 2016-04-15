<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top'), true);


/* check connection */


echo "<form action= ' random_backend.php' method='post'>";




echo "choose a game";

echo "<select name='game'>";


for ($i=0; $i <10 ; $i++) {

  $game_name= $dataArray['top'][$i]['game']['name'];
   echo " <option value=' . $game_name .' >" . $dataArray['top'][$i]['game']['name'] . "</option>";

}







echo "</select> <br>";
echo " min views<input type='number'  name='minviews' value=0 min='0' checked>" ;

echo "<br> <input type= 'submit' value='Find random online stream'> </br>";

echo "</form>";


?>
