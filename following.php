
<?php
/*
*	@author Jamey Ballard
*	@filename following.php
*	@date 2016/5/05
*	@about creates the icon in the tab, writes to the html various information about twitch, gets 100 channels of following users
*/
echo "<link rel='icon' href='http://s.jtvnw.net/jtv_user_pictures/hosted_images/GlitchIcon_purple.png'>"; //the cool icon in the tab
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user= $_POST["user"];

echo "Streams now on twitch";


$n=0; // off set variable
$name = array();
do
{


$dataFollow = json_decode(@file_get_contents('https://api.twitch.tv/kraken/users/' .$user .'/follows/channels?limit=100&offset=' . $n. ''), true);
//grabs the object of a users next 100 follows starting at $n
// this is done as the API will only return 100 channels at a time
$total=$dataFollow['_total']; // the total followers not just the channels in the object



      // an arr TO hold the names of the channel
      if (isset($_POST['on'])) 
      {
           for ($i=0; $i <  count($dataFollow['follows'])  ; $i++) 
           {
                $name[$i+$n]= $dataFollow['follows'][$i]['channel']['name']; // builds an array of all the names from the channel object
           }

           $n=$n+100;
      }else 
      {
           for ($i=0; $i < count($dataFollow['follows']) ; $i++)
           {
                $url=$dataFollow['follows'][$i]['channel']['url'];  // grabs the url of the stream
                echo "<br><font =\"arial\"><a href=\"$url\">" .$dataFollow['follows'][$i]['channel']['name'] ."</a></font></br>"; // Prints the name of the channels and hyperlinks them to there url
           }
      }
// this is the offset variable
}
while(($total -$n)> 0); //This is here to allow it to run for user with more then onehundred folowers


$n=0;

while (($total-$n)>0)
{
    $datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&limit=100&channel=' .implode(",",$name) .''), true);;
 
    // gets an object containing the streams which channels  are part of $dataFollow object  and they are online
    $total=$datastream['_total'];


    // the Implode funiction converts the name array in to a string with commas i.e. trumpsc,firebat,Amaz,... which is what we need to  to build the correct stream object
    for ($i=0; $i < count($datastream['streams']) ; $i++)
    { // loops to print off all online channels

         if ($datastream['streams'][$i]["_id"]!= null) 
	 {  //double checks to make sure
              $url=$datastream['streams'][$i]['channel']['url']; // grabs the url of the stream
              echo "<br> <a href=\"$url\">" .$datastream['streams'][$i]['channel']['name'] ."</a> </br>";      // Prints the name of the channels and hyperlinks them to there url
         }

     }
     $n=$n+100;
}

?>
