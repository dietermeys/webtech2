<?php

//1- check of er gepost is
if(!empty($_POST)){
	//2- file openen
	$file = fopen("nieuwsbrief.txt", "a+");
	//3- email wegschrijven naar file
	fwrite($file, $_POST['email'] . "\n");
	//4- file afsluite
	fclose($file);
}



?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Terrapke</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="css2.css">
</head>
<body onLoad="getLocation()">
	<div id="wrapper">

  <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
  </div>

<div class="row">
	 <div class="col-md-6">
	<h1>Een passie voor het web & apps?</h1>
	<h1>Kom dan mee een terr<span >app</span>ke doen!</h1>
	</div>
</div>
<div class="row">
<div class="col-md-4">
	<h1 id="demo"></h1>
	<img src="" alt="" id="img">
	<h3 id="tekst"></h3>
</div>
</div>
<div class="row">
	 <div class="col-md-6">
	<p>Ga je binnekort verder studeren en wil jij net als ons niets liever doen dan knappe websites, mobile apps en webapplicaties Bouwen?</p>
	<p>Dan ben jij een perfecte kandidaat voor onze opleiding <span>Interactive Multimedia Design</span>.<br /></p>
	<p>Kom mee een terraske doen aan onze <span>Creative Gym</span> en neem meteen een kijkje in onze opleiding aan de Thomas More hogeschool in Mechelen <br /></p>
	<p>Laat je email adres achter en we mailen de exacte datum, locatie en tijdstip naar je door.</p>
	</div>
</div>
<div class="row">
<div class="col-md-5">
<form action="" method="post">
	<input type="email" required name="email" placeholder="Enter your email" size="30">
	<input type="submit" value="Inschrijven" id="button">
</form>
</div>
</div>
</div>
<script>
var text=document.getElementById("tekst");
var x=document.getElementById("demo");
var img=document.getElementById("img");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{
  	x.innerHTML="Geolocation is not supported by this browser.";
  }
  }
function showPosition(position)
  {
  $.ajax({
  url: "https://api.forecast.io/forecast/706203dec1e7bbf5c8c8b47b73a22038/51.024018899999994,4.4848042",
  dataType: "jsonp",

  success: function (data) {
    var tempInF = Math.round((data.currently.temperature - 32)/1.8);
  	x.innerHTML=tempInF + "°C" ;
  	  console.log(data);

var temp = data.currently.icon;
if(temp == "partly-cloudy-day"){

  img.src="images/png/28.png";
}
else if(temp == "partly-cloudy-night"){
    img.src="images/png/27.png";
}
else if(temp == "cloudy"){
  img.src="images/png/26.png";
}
else if(temp == "clear-day"){
  img.src="images/png/32.png";
}
else if(temp == "wind"){
  img.src="images/png/23.png";
}
else if(temp == "clear-night"){
  img.src="images/png/31.png";
}
else if(temp == "partly-cloudy-night"){
  img.src="images/png/33.png";
}
else if(temp == "snow" || temp == "sleet"){
  img.src="images/png/16.png";
}

if(temp == "partly-cloudy-day"){
	text.innerHTML = "Cva weer momenteel, het zonneke schijnt nog wel.";
}
else if(temp == "cloudy" || temp == "rain" || temp == "sleet" || temp == "snow" || temp == "wind" || temp == "fog"){
	text.innerHTML = "Niet zo goed weer om een terraske te doen..";
}
else if(temp == "clear-day"){
	text.innerHTML = "Perfect weer om een terraske te doen!! :)";
}
else if(temp == "clear-night" || "partly-cloudy-night"){
	text.innerHTML = "Beetje laat om nu een terrappke te doen ;)"
}

if(temp == "clear-day"){
	 document.body.style.background = "#f39c12";
}
else{

	document.body.style.background = "#3498db";


}
//clear-night , rain , snow , sleet , wind , fog , hail , thunderstorm
//wind speed miles per hour
//huminidity schaal van 0 - 1

}});
 }
</script>
</body>
</html>