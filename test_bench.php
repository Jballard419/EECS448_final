<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function testfile($test_url, $test)
{


   $myfile = fopen($test, 'r');
   $temp= fread($myfile,filesize($test));
   fclose($myfile);





 $temp =str_replace($test_url,"",$temp);
 $temp =str_replace("?","",$temp);

 return $temp;
}




echo "Welcome to the test <br>";
echo "Before we start two things need to be done <br> 1) ensure that pops are not blocked as otherwise the test cannot run </br> 2)   then refresh this page in order to see correct results  and avoid a  bug  <br>";


$baseurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$test_url= str_replace("test_bench.php","index.html",$baseurl);
$url =str_replace("test_bench.php","random_backend.php?test=test1.txt",$baseurl);

echo "<script type='text/javascript'> win=window.open('". $url . "', '_blank');




 </script>";







echo "Test one: does random_backend give us a valid url <br>";

$test="test1.txt";
$temp=testfile($test_url, $test);
parse_str ( $temp );
if(isset($channel_name) ){
  echo " random_backend works<br>";
}else {
  echo "<br> test failed <br> ";
  echo $temp;
}

echo "Test two: Test the Game filter<br>";

$url =str_replace("test_bench.php","random_backend.php?test=test2.txt&game=Hearthstone%3A%20Heroes%20of%20Warcraft",$baseurl);


echo '<script type="text/javascript">   window.open("'.$url.'", "_blank");   </script>';

$test="test2.txt";
$temp=testfile($test_url, $test);

parse_str ( $temp );
echo $channel_name. " channel_name";
$datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel='. $channel_name .''), true);

if(strcasecmp(  $datastream['streams'][0]['viewers'], "Hearthstone: Heroes of Warcraft") )
{
  echo "The test work <br>";


}else {

  echo "<br> test failed <br> ";
  echo $temp;
}

echo "Test Three: Test max filter<br>";

$url = str_replace("test_bench.php","random_backend.php?test=test3.txt&game=&maxviews=1000",$baseurl);


echo '<script type="text/javascript">   window.open("'.$url.'", "_blank"); </script>';


$test="test3.txt";
$temp=testfile($test_url, $test);

parse_str ($temp);

$datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel='. $channel_name .''), true);

if( $datastream['streams'][0]['viewers']<1000 )
{
  echo "max Filter  work as well <br>";


}else {
  echo "<br> test failed <br> ";
  echo $datastream['streams'][0]['viewers'];

}

echo "Test Four: Test Min filter<br>";

$url = str_replace("test_bench.php","random_backend.php?test=test4.txt&game=&minviews=1000",$baseurl);


echo '<script type="text/javascript">   window.open("'.$url.'", "_blank"); </script>';


$test="test4.txt";
$temp=testfile($test_url, $test);

parse_str ($temp);

$datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel='. $channel_name .''), true);

if( $datastream['streams'][0]['viewers']>1000 )
{
  echo "Min Filter  work as well <br>";


}else {
  echo "<br> test failed <br> ";

  echo $url;
}

echo "Test Five: Test language filter<br>";

$url = str_replace("test_bench.php","random_backend.php?test=test5.txt&language=ru",$baseurl);


echo '<script type="text/javascript">   window.open("'.$url.'", "_blank"); </script>';


$test="test5.txt";
$temp=testfile($test_url, $test);

parse_str ( $temp );

$datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel='. $channel_name .''), true);

if( $datastream['streams'][0]['channel']['language']=="ru" )
{
  echo "Language Filter  work as well <br>";


}else {
  echo "<br> test failed <br> ";
  echo $channel_name;
  echo "<br>". $temp . "<br>";
  echo "<br>". $url. "<br>";
  echo $datastream['streams'][0]['channel']['language'];
}

echo "Test 6 does 3d checkbox work";


$url =str_replace("test_bench.php","random_backend.php?dim=pie&test=test6.txt",$baseurl);
echo '<script type="text/javascript">   window.open("'.$url.'", "_blank"); </script>';
$test_url= "http://people.eecs.ku.edu/~jballard/Final/three.js-master/examples/css3d_youtube.html";
$temp=testfile($test_url, "test6.txt" );



$datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?channel='. $temp.''), true);

if($datastream['_total']== 4){
  echo "<br> test 6 works <br>";
  echo "<br> if all tests have worked so far random_backend.php and extension_random.php work <br>";
}else {
  echo "<br> Test failed <br>";
}



echo "<br> now to test randfollow.php </br>";

$url =str_replace("test_bench.php","randfollow.php?user=Serpent99&test=test7.txt",$baseurl);

echo '<script type="text/javascript">   window.open("'.$url.'", "_blank"); </script>';

$test_url= str_replace("test_bench.php","index.html",$baseurl);


$temp=testfile($test_url, "test7.txt" );

parse_str ( $temp );

$datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams/'. $channel_name .''), true);


$data_channel=json_decode(@file_get_contents('https://api.twitch.tv/kraken/users/Serpent99/follows/channels/' . $channel_name. ''), true);

if($datastream['stream']!=null & isset($data_channel['created_at'])){
  echo "randfollow.php works<br> ";
}else {
  echo "randfollow failed <br> ";
  echo "Note: this could be due to none of the channels Serpent99 follows being online";
}





















//  ?>
