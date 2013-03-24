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
	
	if(isMusicPlayer())
	{
		$stream = getFreeStream($streams);
		if($stream)
		{
			header("Location: ".$stream);
		}
		else
		{
			header("HTTP/1.0 401 All SHOUTcast-Servers are full");
			header("icy-notice1: <BR>SHOUTcast Distributed Network Audio Server/Linux v1.9.8<BR>");
			header("icy-notice2: All SHOUTcast-Servers are full<BR>");
		}
	}
	elseif(isStreamRipper())
	{
		header("HTTP/1.0 401 Streamripping was disabled for this Stream");
		header("icy-notice1: <BR>SHOUTcast Distributed Network Audio Server/Linux v1.9.8<BR>");
		header("icy-notice2:Streamripping was disabled for this Stream<BR>");
	}
	else
	{
		if(SHOW_SITE)
		{
			include("site.php");
		}
		else
		{
			include("download.php");
		}
	}
u();?>