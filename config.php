<?php
#####################################################
#													#
#	Autor:		Max Nowack							#
#	Website:	www.dasnov.de						#
#	Produkt:	SCred								#
#	Version:	1.0									#
#													#
#####################################################
#													#
#	Die Software ist Mindware						#
#	Mindware ist eine Vertriebsform von Software,	#
#	bei der sie zunächst kostenlos erworben wird	#
#	und es dem Nutzer freigestellt ist, dem Autor	#
#	des Programms den Betrag zu zahlen, der ihm		#
#	angemessen erscheint. Es wird das 				#
#	"Zahle-was-du-willst-Prinzip" angewendet.		#
#	Ein entsprechender Button befindet sich auf		#
#	meiner Homepage.								#
#													#
#####################################################


/********************** Grundeinstellungen **********************/

define("RADIO_NAME",	"IhrRadio.FM");			//Name des Webradios
define("SHOW_SITE",		true);					//Wenn "true" wird die Seite "site.php" eingebunden

//Mitschneiden von Songs verbieten. (ohne Gewähr)
define("ALLOW_RIPPING",	true);

//Clients deren User-Agent diese Wörter enthält,
//werden bei ALLOW_RIPPING=false ausgesperrt.
//Die Wörter werden mit einer Pipe (|) getrennt.
define("FORBIDDEN_USERAGENTS",	"ripper|proxy");


//Dieser Wert entscheidet, ab wie vielen freien
//Listenerplätzen ein anderer Stream gewählt wird.
define("FREE_LISTENER",		10);

//Versenden der Updateinformationen ein oder ausschalten
define("UPDATE",		true);

//Ihre Email-Adresse an die Updateinformationen versendet werden.
define("ADMIN_EMAIL",	"mail@example.com");

//Definierte Streams.
//Format "ip:port:adminpasswort"
$streams =	array(
				"192.168.1.2:8000:changeme",
				"192.168.1.2:8010:changeme"
			);
	
?>