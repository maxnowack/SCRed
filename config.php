<?php

define("RADIO_NAME",	"YourRadio.FM");	//Name of your radio station
define("SHOW_SITE",		true);					//should the file "site.php" be included?

//Ripping
define("ALLOW_RIPPING",	true);

//Programs whose user-agent contains one of these words, will get an error message if ALLOW_RIPPING is false.
//The words are separated with "|"
define("FORBIDDEN_USERAGENTS",	"ripper|proxy");

//Maximum users per stream
define("FREE_LISTENER",		10);

//Your SHOUTcast servers
//Format "ip:port:adminpasswort"
$streams =	array(
	"192.168.1.2:8000:changeme",
	"192.168.1.2:8010:changeme"
);

?>
