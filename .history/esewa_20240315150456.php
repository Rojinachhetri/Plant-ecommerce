<?php
session_start();

require './includes/conn.php';

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: /Plant");
    exit();
}
$url = "https://uat.esewa.com.np/epay/main";
$data = [
    'amt' => $amt,
    'pdc' => 0,
    'psc' => 0,
    'txAmt' => 0,
    'tAmt' => $amt,
    'pid' => $id,
    'scd' => 'EPAYTEST',
    'su' => 'http://localhost:8000/MeroPizza/pages/cart.php?q=su',
    'fu' => 'http://localhost:8000/MeroPizza/pages/cart.php?q=fu'
];

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
