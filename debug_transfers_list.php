<?php
require_once ('includes/common.php');

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.paystack.co/transfer",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => [
    "authorization: Bearer ".testKey, 
    "cache-control: no-cache"
],
));

$response = curl_exec($curl);

print_r ($response);
?>