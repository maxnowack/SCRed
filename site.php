<?php
require_once("config.php");
require_once("functions.php");

echo "<?xml version=\"1.0\" ?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Listen <?php echo RADIO_NAME; ?></title>
	<style type="text/css">
		* {
			font-family: Arial,Verdana;
			font-size: 10pt;
		}

		#id {
			font-size: 8pt;
		}
	</style>
	</head>
	<body>
		<div align="center">
			<table width="50%">
				<tr>
					<td colspan="3">
						Listen <?php echo RADIO_NAME; ?> with...
					</td>
				</tr>
				<tr>
					<td align="center" width="33%"><a href="listen.asx">Windows Media Player</a></td>
					<td align="center" width="33%"><a href="listen.pls">Winamp</a></td>
					<td align="center" width="33%"><a href="listen.ram">Realplayer</a></td>
				</tr>
			</table>
		</div>
		<div align="center" id="copyright">
		    <p>Submit issues on <a href="https://github.com/maxnowack/SCRed">Github</a></p>
		</div>
	</body>
</html>
