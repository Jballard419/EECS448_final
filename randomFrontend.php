<?php



error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top?limit=50'), true);





echo "<form action= ' random_backend.php' method='post' id='rand_stream'>";




echo "choose a game";

echo "<select name='game'>";
echo " <option value='' > Give me anything </option>";

for ($i=0; $i <50 ; $i++) {

  $game_name= $dataArray['top'][$i]['game']['name'];
   echo " <option value=' . $game_name .' >" . $dataArray['top'][$i]['game']['name'] . "</option>";

}







echo "</select> <br>";



echo "<div id='Filters'>";

  echo "Language";
  echo " <select name='language' id='language'> ";

  echo "<option value=>   </option>";
  echo "<option value=en> English </option>";
  echo "<option value=ru> Russian </option>";
  echo "<option value=fr> French </option>";
  echo "<option value=de> German </option>";
  echo "<option value=es> Spanish </option>";
  echo "<option value=pt> Portuguese </option>";
  echo "<option value=zh> Chinese </option>";
  echo "<option value=cs> Czech </option>";
  echo "<option value=tr> Turkish </option>";
  echo "<option value=ko> Korean </option>";




echo "</select>";

echo "3d? <input type='checkbox' name='dim' value='true' />    " ;


echo " min views<input type='number'  name='minviews'  min='0' checked>" ;
echo " max views<input type='number'  name='maxviews'  min='0' checked> </br> </div>" ;


echo " <input type= 'submit' value='Find random online stream'> ";



echo "</form> ";
echo "<button id=Add_Filters onclick='filters()'>Add Filters</button>";
echo "<button id=Hide_Filters onclick='filters()'> Hide Filters</button>";


?>
