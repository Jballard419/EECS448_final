//Getting JSON object containing top 50 games
gamelist = $.getJSON('https://api.twitch.tv/kraken/games/top?limit=50', function(){console.log("JSON call finished");})
	//Wait for JSON call to finish, then do this stuff
	.done(function()
	{
		//Adding those 50 games to drop-down menu in popup.html
		gamemenuselect = document.getElementById("gameslist");
		for(i = 0; i < 50; i++)
		{
			gametoadd = gamelist['responseJSON']['top'][i]['game']['name'];
			var option = document.createElement('option');
       			option.text = gametoadd;
			option.value = gametoadd;
       			gameslist.add(option, i+1);
		}
	}
);

function openrandomstream()
{
	//---------------------------------------------
	//Getting random filter values from user inputs
	//---------------------------------------------

	//Getting language choice
	var language_choice = document.getElementById("language_selection");
	var language = language_choice.value;

	//Getting game choice
	var game_choice = document.getElementById("gameslist");
	var game = game_choice.value;

	//Getting value for minimum view count, and if no specified value, set to 0
	var min_viewercount = document.getElementById('mincount').value;

	if((min_viewercount == "")||(isNaN(min_viewercount)))
	{
		min_viewercount = 0;
	}

	//Getting value for maximum viewer count
	var max_viewercount = document.getElementById('maxcount').value;

	if((min_viewercount == "")||(isNaN(max_viewercount)))
	{
		max_viewercount = 1000000;
	}
	
	//Encoding game name to pass into URL
	game_encoded = encodeURIComponent(game);

	//Building URL to redirect to.
	var randstream_url = "http://people.eecs.ku.edu/~jballard/Final/extension_random.php?game="+game_encoded+"&minviews="+min_viewercount+"&maxviews="+max_viewercount+"&language="+language;

	//Opening new tab with that URL. 
	chrome.tabs.create({ url:randstream_url});
	
}

//Adding onclick functionality to "Go to random stream!" button
//When clicked, this button will call redirecttostream
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('randomstream');
  if (btn) {
    btn.addEventListener('click', openrandomstream);
  }
});
