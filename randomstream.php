<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$cname = $_GET["channel_name"];

echo "<div align='left'>
    <object type='application/x-shockwave-flash' height='500' width='900'     id='live_embed_player_flash' data='http://www.twitch.tv/widgets/live_embed_player.swf?channel=".$cname."' bgcolor='#000000'>
        <param name='allowFullScreen' value='true' />
        <param name='allowScriptAccess' value='always' />
        <param name='allowNetworking' value='all' />
        <param name='movie' value='http://www.twitch.tv/widgets/live_embed_player.swf' />
        <param name='flashvars' value='hostname=www.twitch.tv&channel=".$cname."&auto_play=true&start_volume=25' />
    </object>

<div align='right'>
    <iframe frameborder='0' scrolling='no' src='http://twitch.tv/".$cname."/chat?popout=' height='500' width='350'>
    </iframe>
</div>";


/*
echo "<div align='left'>
    <object type='application/x-shockwave-flash' height='500' width='900' id='live_embed_player_flash' data='http://www.twitch.tv/widgets/live_embed_player.swf?channel=trumpsc bgcolor='#000000'>
        <param name='allowFullScreen' value='true' />
        <param name='allowScriptAccess' value='always' />
        <param name='allowNetworking' value='all' />
        <param name='movie' value='http://www.twitch.tv/widgets/live_embed_player.swf' />
        <param name='flashvars' value='hostname=www.twitch.tv&channel=trumpsc &auto_play=true&start_volume=25' />
    </object>
<div align='right'>
    <iframe frameborder='0' scrolling='no' src='http://twitch.tv/trumpsc/chat?popout='  height='500' width='350'>
    </iframe>
</div>";
*/

//echo "<iframe src='http://player.twitch.tv/?channel=monstercat' allowfullscreen></iframe>"

?>
