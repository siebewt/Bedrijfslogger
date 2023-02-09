<?php 
$curl = curl_init();

//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$headers[] = 'Authorization: Basic ' . 'l7xx1f2691f2520d487b902f4e0b57a0b197';
curl_setopt($curl, \CURLOPT_CAINFO, 'C:\\xampp\\php\\cacert.pem');
curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
curl_setopt($curl, CURLOPT_URL, "https://api.kvk.nl/test/api/v1/zoeken?handelsnaam=test");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);

var_dump(curl_error($curl));
var_dump($output);
curl_close($curl);
?>