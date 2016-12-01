<?php
    date_default_timezone_set('UTC');
    $curl = curl_init();
    $apiUser = "TEST";
    $apiSecret = "testsleutel";
    $klantNummer = "8700";
    $datum = date_format(date_create(), "d-m-Y G:i:s.u");
    $baseString = sprintf("%s|%s|%s", substr($datum, 0, 10), substr($datum, 11, 12), $klantNummer);
    $headers = [
        'Content-Type: application/xml',
        'Accept: application/xml',
        'Timestamp: '.substr($datum, 0, 23),
        'Klantnummer: '.$klantNummer,
	    'Authentication: '.sprintf("%s:%s", $apiUser, base64_encode(hash_hmac("sha256", $baseString, strtoupper($apiSecret), true))),
    ];

    curl_setopt($curl, CURLOPT_URL, "https://acceptatie.sdbstart.nl/Start/api/dienstverbanden");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($curl);
    curl_close ($curl);
    print_r($server_output);
?>