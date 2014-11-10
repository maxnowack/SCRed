<?php
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
?>
