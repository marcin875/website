<?php
header('Content-Type: application/json');

// Put your AviationStack API key here
$apiKey = 'ebb58221272e77ec551eb25515f913c0';

// Get registration from query string
$reg = isset($_GET['reg']) ? urlencode($_GET['reg']) : '';

if (!$reg) {
    echo json_encode(['error' => 'No registration provided']);
    exit;
}

// Build AviationStack URL
$url = "http://api.aviationstack.com/v1/aircraft?access_key={$apiKey}&registration={$reg}";

// Fetch data
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code != 200) {
    echo json_encode(['error' => 'API request failed']);
    exit;
}

echo $response;
