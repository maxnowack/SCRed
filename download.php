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


	require_once("config.php");
	require_once("functions.php");
	error_reporting(0);
	
	$url = getURL();
	switch($_GET['type'])
	{
		case "ram":
			header("Content-Type: audio/x-pn-realaudio");
			header("Content-Disposition: attachment; filename=\"listen.ram\"");
			echo $url;
			break;
			
		case "asx":
			header("Content-Type: video/x-ms-asf");
			header("Content-Disposition: attachment; filename=\"listen.asx\"");
			echo "<asx version=\"3.0\">\n";
			echo "	<title>".RADIO_NAME."</title>\n";
			echo "	<entry>\n";
			echo "		<ref href=\"$url\" />\n";
			echo "	</entry>\n";
			echo "</asx>";
			break;
			
		case "pls":
			header("Content-Type: audio/x-scpls");
			header("Content-Disposition: attachment; filename=\"listen.pls\"");
			echo "[playlist]\n";
			echo "NumberOfEntries=1\n";
			echo "File1=$url";
			break;
		
		default:
			header("Content-Type: audio/x-mpegurl");
			header("Content-Disposition: attachment; filename=\"listen.m3u\"");
			echo $url;
	}
?>