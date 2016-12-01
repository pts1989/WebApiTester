<?php
error_reporting(E_ALL);
$apiUser = "TEST";
$apiSecret = "testsleutel";
$klantNummer = "8700";
date_default_timezone_set('UTC');
$datum = date_format(date_create(),"d-m-y G:i:s.u");
$baseString = sprintf("%s|%s|%s", substr($datum, 0, 8),substr($datum, 9, 12), $klantNummer);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://acceptatie.sdbstart.nl/Start/api/dienstverbanden");
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'Cache-Control: no-cache',
    'Content-Type: application/xml; charset=utf-8',
    'Timestamp: '.$datum,
    'Klantnummer: '.$klantNummer,
	'Authentication: '.sprintf("%s:%s", $apiUser,$baseString)
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if( ! $result = curl_exec($ch))
{
    trigger_error(curl_error($ch));
}

print_r( $result);
$server_output = curl_exec ($ch);

curl_close ($ch);


print_r($server_output);
print_r($headers);
print_r($httpCode);

?>