<?php
error_reporting(-1);
$apiUser = "TEST";
$apiSecret = "testsleutel";
$klantNummer = "8700";
date_default_timezone_set('UTC');
$datum = date_format(date_create(),"d-m-y G:i:s.u");
$baseString = sprintf("%s|%s|%s", substr($datum, 0, 8),substr($datum, 9, 12), $klantNummer);
echo "test";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://acceptatie.sdbstart.nl/Start/api/dienstverbanden");
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo "test2";
$headers = [
    'Cache-Control: no-cache',
    'Content-Type: application/xml; charset=utf-8',
    'Timestamp: '.$datum,
    'Klantnummer: '.$klantNummer,
	'Authentication: '.sprintf("%s:%s", $apiUser,$baseString)
];
print_r($headers);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
echo "test3";
if( ! $result = curl_exec($ch))
{
    trigger_error(curl_error($ch));
}

print_r( $result);
$server_output = curl_exec ($ch);
echo "test4";
curl_close ($ch);
echo "test5";

print_r($server_output);
echo "henk";
phpinfo();
?>