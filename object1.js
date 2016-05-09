/*
 * 	@author: Jamey Ballard, Justin Lee
 * 	@date:	 2016/05/6
 * 	@filename: object1.js
 */

var path = window.location.pathname.toString();
var substring = path.substring(2,7);

if(substring == 'jrlee')
{
  window.CLIENT_ID = 'tn1skh051b84wkb0w2ny2ssjdnf0vlv';

}else if (substring == 'jball')
{
  window.CLIENT_ID = 'chzhhf3qvb0bv89z29je42su5rm30zo';
}else if(substring == 'bgive')
{
    window.CLIENT_ID = '7uoxuhkie51y95c9xcqfp5shf5zxq6b';
}

// code below came  from http://justintv.github.io/twitch-js-sdk/example.html
//as a Base to learn how to log in. and use the API in general
$(function()
{
  // Initialize. If we are already logged in, there is no
  // need for the connect button
  Twitch.init({clientId: CLIENT_ID}, function(error, status)
  {
    if (status.authenticated)
    {
      // we're logged in :)
      $('.status input').val('Logged in! Allowed scope: ' + status.scope);
      // Show the data for logged-in users
      $('.authenticated').removeClass('hidden');
    }else
    {
      $('.status input').val('Not Logged in! Better connect with Twitch!');
      // Show the twitch connect button
      $('.authenticate').removeClass('hidden');
    }
  });

  $('.twitch-connect').click(function()
  {
    Twitch.login({scope: ['user_read', 'channel_read']});
    var form=document.forms['uservalue'];
    form.elements['token'].value= Twitch.getToken();
  })

  $('#logout button').click(function() {
    Twitch.logout();

    // Reload page and reset url hash. You shouldn't
    // need to do this.
    window.location = window.location.pathname
  })

  $('#get-name button').click(function() {
         Twitch.api({method: 'user'}, function(error, user) {
           $('#get-name input').val(user.display_name);
         });
       })

  $('#get-stream-key button').click(function()
  {
    Twitch.api({method: 'channel'}, function(error, channel)
    {
      $('#get-stream-key input').val(channel.stream_key);
      // var form=document.forms['uservalue'];
      // form.elements['token'].value= Twitch.getToken();
    });
  })

});
