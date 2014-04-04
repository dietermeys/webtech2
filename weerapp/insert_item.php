<?php
//alle gegevens om connectie te leggen naar de databank
$host = "https://dbadmin.one.com/";
$user = "dietermeys_be";
$pass = "5vrAcitr";
$database = "dietermeys_be";
//connectie leggen naar de databank
$go = true;

if(isset($_GET['name'])){
	$name = $_GET['name'];
}
else{
	$go = false;
}

// bij insert zijn channelID, title en description verplicht in te vullen. itemID = autonummering.

if($go){
	$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host.");
	mysql_select_db($database, $linkID) or die("Could not find database.");
	
	$sqlquery="INSERT INTO songs (`naam`)VALUES("."'".$name."'".");";
	mysql_query($sqlquery);
	mysql_close();
}
?>