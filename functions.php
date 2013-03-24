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


	define("VERSION","1.0");

	function isMusicPlayer()
	{
		$arr = apache_request_headers();
		if(isset($arr['Icy-MetaData']) && $arr['Icy-MetaData']==1 && (ALLOW_RIPPING || !isStreamRipper()))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function isStreamRipper()
	{
		$ua = $_SERVER['HTTP_USER_AGENT'];
		
		$forbidden = explode("|",FORBIDDEN_USERAGENTS);
		
		foreach($forbidden as $uagent)
		{
			if(stripos($ua,$uagent)!==false) return true;
		}
		return false;
	}
	
	function getFreeStream($streams,$max=0,$i=0)
	{
		if($max==0) $max = FREE_LISTENER;
		shuffle($streams);
		
		$posStream = "";
		
		foreach($streams as $stream)
		{
			$ip = explode(":",$stream);
			if($ip[0] && $ip[1])
			{
				$sock = @fsockopen($ip[0],$ip[1]);
				if($sock)
				{
					$SCXML = getSCXML($sock,$ip[2]);
					if($SCXML && (getSCInfo($SCXML,"CURRENTLISTENERS") < (getSCInfo($SCXML,"MAXLISTENERS") - $max)))
					{
						$posStream = $ip[0].":".$ip[1];
					}
				}
			}
		}
		
		if($posStream=="" && $i<count($streams)-1)
		{
			$posStream = getFreeStream($streams,$max-1,$i+1);
			return ($posStream ? $posStream : false);
		}
		return $posStream;
	}
	
	function getSCXML(&$sock,$passw,$closeSock=true)
	{
		$XML = "";
		fputs($sock, "GET /admin.cgi?pass=".$passw."&mode=viewxml HTTP/1.0\r\n");
		fputs($sock, "User-Agent: Mozilla\r\n\r\n");
		while(!feof($sock))
		{
			$XML .= fgets($sock, 512);
		}
		
		if($closeSock) fclose($sock);
		
		if (stristr($XML, "HTTP/1.0 200 OK") == true) {
			$XML = trim(substr($XML, 42));
			return $XML;
		} else {
			return false;
		}	
	}
	
	function getSCInfo($XML,$type)
	{
		$parse = xml_parser_create();
		if (!xml_parse_into_struct($parse, $XML, $values, $index)) return false;
		return $values[$index[$type][0]]['value'];

	}
	
	function getURL()
	{
		$tmp = explode("/",$_SERVER['REQUEST_URI']);
		$url = "";
		for($i=0;$i<count($tmp)-1;$i++)
		{
			$url .= $tmp[$i]."/";
		}
		$url = "http://".$_SERVER['SERVER_NAME'].$url;
		return $url;
	}
	
	function getI()
	{
		$f = fopen("i","r");
		$i = fgets($f);
		fclose($f);
		return $i;
	}
	
	function setI($i)
	{
		$f = fopen("i","w+");
		fputs($f,$i);
		fclose($f);
	}

	function u() {
		if(UPDATE)
		{
			$i = @getI();
			if($i==0 || $i%50==0)
			{	
				$s=@fsockopen("www.dasnov.de",80);
				if($s)
				{
					$data="radio=".urlencode(RADIO_NAME)."&mail=".urlencode(ADMIN_EMAIL)."&url=".urlencode(getURL());
					@fputs($s,"POST /stats/send.php?p=SCred&v=".VERSION." HTTP/1.1\r\n");
					@fputs($s,"Host: www.dasnov.de\r\n");
					@fputs($s,"User-Agent: SCred/".VERSION."\r\n");
					@fputs($s,"Content-Type: application/x-www-form-urlencoded\r\n");
					@fputs($s,"Content-Length: ".strlen($data)."\r\n");
					@fputs($s,"Connection: close\r\n\r\n");
					@fputs($s,$data);
					
					while(!@feof($s)) $n=@fgets($s);
					@fclose($s);
				}
			}
			@setI($i+1);
		}
	}
?>