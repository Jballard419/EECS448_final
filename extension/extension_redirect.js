function createTabBrandon() 
{
	chrome.tabs.create({ url:"http://people.eecs.ku.edu/~bgivens/EECS448/EECS448_final/index.html"});
}

function createTabJames() 
{
	chrome.tabs.create({ url:"http://people.eecs.ku.edu/~jballard/Final/index.html"});
}

function createTabJustin() 
{
	chrome.tabs.create({ url:"http://people.eecs.ku.edu/~jrlee/EECS448/EECS448_final/index.html"});
}

document.addEventListener('DOMContentLoaded', function () 
{
  var btn = document.getElementById('BrandonButton');
  if (btn) {
    btn.addEventListener('click', createTabBrandon);
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('JamesButton');
  if (btn) {
    btn.addEventListener('click', createTabJames);
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('JustinButton');
  if (btn) {
    btn.addEventListener('click', createTabJustin);
  }
});