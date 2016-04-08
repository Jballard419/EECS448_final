<?php
/*
*	@author: Jamey Ballard
*	@date:	4/8/2016
*	@filename: randfollow.php
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user= $_POST["user"];


echo "<font =\"arial\">Streams now on twitch<font>";

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

$name = array();




for ($i=0; $i < $temp ; $i++) {
  $name[$i]= $dataArray['follows'][$i]['channel']['name'];
}



 $datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&limit=100&channel=' .implode(",",$name) .''), true);; // TO DO make this run quicker

for ($i=0; $i < count($datastream['streams']) ; $i++) {
  # code...

  if ($datastream['streams'][$i]["_id"]!= null) {
    # code...

      $urlarr[$i+$n]=$datastream['streams'][$i]['channel']['url'];





      }

        }



$length=$length-100;
$n=$n+100;

}while($length> 0);

$rand_keys = array_rand($urlarr);

$url= $urlarr[$rand_keys];

header('Location: '.$url);
die();


 ?>
