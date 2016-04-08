
<?php
/*
*	author: Jamey Ballard
*	@filename: following.php
*	@date: 4/8/2016
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user= $_POST["user"];

echo "Streams now on twitch";

$length=0;
$n=0;
do
{


$dataFollow = json_decode(@file_get_contents('https://api.twitch.tv/kraken/users/' .$user .'/follows/channels?limit=100&offset=' . $n. ''), true);
 //grabs the object of a users next 100 follows starting at zip_entry_open
// this is done as the API will only return 100 channels at a time
$total=$dataFollow['_total'];
if ($length<=0) {
  $length=$total;
}

if($length>100){
  $temp= 100;
}else {
  $temp=$length;
}

$name = array();


if (isset($_POST['on'])) {

for ($i=0; $i < $temp ; $i++) {
  $name[$i]= $dataFollow['follows'][$i]['channel']['name']; // builds an array of all the names from the channel object
}



 $datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&limit=100&channel=' .implode(",",$name) .''), true);;
 // gets an object containing the streams which channels  are part of $dataFollow object  and they are online

 // the Implode funiction converts the name array in to a string with commas i.e. trumpsc,firebat,Amaz,... which is what we need to  to build the correct stream object



for ($i=0; $i < count($datastream['streams']) ; $i++) { // loops to print off all online channels


  if ($datastream['streams'][$i]["_id"]!= null) { // 


  $url=$datastream['streams'][$i]['channel']['url']; // grabs the url of the stream



  echo "<br> <a href=\"$url\">" .$datastream['streams'][$i]['channel']['name'] ."</a> </br>";
      }

        }
}else {


  for ($i=0; $i < $temp ; $i++) {
    $url=$dataFollow['follows'][$i]['channel']['url'];
   echo "<br><font =\"arial\"><a href=\"$url\">" .$dataFollow['follows'][$i]['channel']['name'] ."</a></font></br>";

 }
}


$length=$length-100;
$n=$n+100;

}while($length> 0);

 ?>
