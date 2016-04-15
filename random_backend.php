<?php

$game = $_POST["game"];
$game=urlencode($game);
$minviews=$_POST["minviews"];
$game=trim($game, "+.");

$n=0;
$fin_index=0;

$rand_num=5;
if ($minviews!=0) {
  # code...

do{
 $streamArray= json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&language=en&offset='. $n . '&limit=100&game=' . $game .''), true);;
//
//
//
//
 $total = $streamArray["_total"];
 //echo $total. "<br>";
 $q=count($streamArray["streams"])-1;


 if($streamArray["streams"][$q]["viewers"]<$minviews){

  for ($i=0; $i <$q ; $i++) {



       if($streamArray["streams"][$i]["viewers"]<$minviews)
       {

         $total=0;
         break;
       }else {
         $fin_index++;
       }


  }


  } else {
    $fin_index=$fin_index+100;


  }



$n=$n+100;



}while (($total-$n)>0);
}else {

  $streamArray= json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&language=en&limit=25&game=' . $game .''), true);;
  $total = $streamArray["_total"];
  $fin_index=$total;


}





$rand_num = rand(0, $fin_index-1);

$random_stream= json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&language=en&offset='. $rand_num . '&game=' . $game .''), true);;


$url=$random_stream['streams'][0]['channel']['url'];


  header('Location: '.$url); //redircet to our random Url
 die();




 ?>
