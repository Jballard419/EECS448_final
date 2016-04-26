//Getting JSON object containing top 50 games
gamelist = $.getJSON('https://api.twitch.tv/kraken/games/top?limit=50', function(){console.log("JSON call finished");})
	//Wait for JSON call to finish, then do this stuff
	.done(function()
	{
		//Adding those 50 games to drop-down menu in popup.html
		gamemenuselect = document.getElementById("gamelist");
		for(i = 0; i < 50; i++)
		{
			gametoadd = gamelist['responseJSON']['top'][i]['game']['name'];
			var option = document.createElement('option');
       			option.text = gametoadd;
			option.value = gametoadd;
       			gameslist.add(option, i+1);
		}
	});
