<?php

if($_REQUEST['key'] == '21324' && $_REQUEST['format'] == 'xml'){
	$File_Path = "/tmp/boat/current_status.txt";
	$fh = fopen($File_Path, 'r');
	$data = fread($fh, filesize($File_Path));
	fclose($fh);
	$xml = new SimpleXMLElement('<xml/>');
	$track = $xml->addChild('data');
	$track->addChild('wtgps', $data);
	Header('Content-type: text/xml');
	print($xml->asXML());
}
else{
	$data = "key not exist";
	$xml = new SimpleXMLElement('<xml/>');
	$track = $xml->addChild('data');
	$track->addChild('error', $data);
	Header('Content-type: text/xml');
	print($xml->asXML());
}	

?>