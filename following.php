<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
$user= $_POST["user"];


echo "Streams now on twitch";

$length=0;
$n=0;
do
{

// $dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams/followed'), true);

// echo "<br> hi ". $total. "</br>";
$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/users/' .$user .'/follows/channels?limit=100&offset=' . $n. ''), true);
$total=$dataArray['_total'];
if ($length<=0) {
  $length=$total;
}

if($length>100){
  $temp= 100;
}else {
  $temp=$length;
}


for ($i=0; $i < $temp ; $i++) {
  $name= $dataArray['follows'][$i]['channel']['name'];
  if (isset($_POST['on'])) {
    # code...

  $datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel=' .$name .''), true);; // TO DO make this run quicker
  if ($datastream['streams']!= null) {
    # code...

  $url=$dataArray['follows'][$i]['channel']['url'];



  echo "<br> <a href=\"$url\">" .$name ."</a> </br>";
}

} else {
  $url=$dataArray['follows'][$i]['channel']['url'];

  echo "<br> <a href=\"$url\">" .$name ."</a> </br>";
}


}


$length=$length-100;
$n=$n+100;

}while($length> 0);





 ?>
