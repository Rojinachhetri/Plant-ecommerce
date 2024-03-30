<?php
session_start();
require './includes/conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /Plant");
    exit();
}

// Generate a secure and unique order ID
$pid = 'orders.id_' . $_SESSION['user_id'] . '_' . hash('sha256', uniqid());

// Fetch order items and calculate total amount
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `orders` WHERE user_id = ?";
$statement = mysqli_prepare($con, $query);
if (!$statement) {
    echo "Error preparing statement: " . mysqli_error($con);
    exit();
}

mysqli_stmt_bind_param($statement, "i", $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$data = [];
$sum = $quantity = 0;
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
    $sum += $row['qty'] * $row['price'];
    $quantity += $row['qty'];
}
$delivery_charge = $quantity * 49;
$total_amount = $sum + $delivery_charge;
mysqli_stmt_close($statement);

// Define Esewa payment parameters
$esewa_url = "https://uat.esewa.com.np/epay/main";
$esewa_data = [
    'amt' => $sum,
    'pdc' => $delivery_charge,
    'psc' => 0,
    'txAmt' => 0,
    'tAmt' => $total_amount,
    'pid' => $pid,
    'scd' => 'EPAYTEST',
    'su' => 'http://localhost:8080/Plant/success.php?q=su',
    'fu' => 'http://localhost:8080/Plant/failed.phpq?=fu'
];

// Send payment request to Esewa
$curl = curl_init($esewa_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $esewa_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

if ($response === false) {
    echo "Error communicating with Esewa: " . curl_error($curl);
    curl_close($curl);
    exit();
}

curl_close($curl);

// Redirect to Esewa payment page if request successful
if (!empty($response)) {
    $response_data = json_decode($response, true);
    if (isset($response_data['checkoutUrl'])) {
        $payment_url = $response_data['checkoutUrl'];
        header("Location: $payment_url");
        exit();
    } else {
        echo "Error processing Esewa payment.";
        exit();
    }
} else {
    echo "Empty response received from Esewa.";
    exit();
}
?>
