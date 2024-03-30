<?php
session_start();
require './includes/conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /Plant");
    exit();
}

// Initialize variables
$pid = 'ORDER_ID_' . $_SESSION['user_id'] . '_' . time(); // Generate unique order ID

// Fetch order items and calculate total amount
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `orders` WHERE user_id = ?";
$statement = mysqli_prepare($con, $query);
if (!$statement) {
    // Handle the case where mysqli_prepare failed
    echo "Error preparing statement: " . mysqli_error($con);
    exit();
}

// Proceed with binding parameters and executing the statement
mysqli_stmt_bind_param($statement, "i", $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

// $statement = mysqli_prepare($con, $query);
// mysqli_stmt_bind_param($statement, "i", $user_id);
// mysqli_stmt_execute($statement);
// $result = mysqli_stmt_get_result($statement);

$data = [];
$sum = $quantity = 0;
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
    $sum += $row['qty'] * $row['price'];
    $quantity += $row['qty'];
}
$delivery_charge = $quantity * 49; // Calculate total delivery charge
$total_amount = $sum + $delivery_charge; // Calculate total amount including delivery charges
mysqli_stmt_close($statement);

// Define Esewa payment parameters
$url = "https://uat.esewa.com.np/epay/main";
$data = [
    'amt' => $sum, // Product amount
    'pdc' => $delivery_charge, // Delivery charge
    'psc' => 0,
    'txAmt' => 0,
    'tAmt' => $total_amount, // Total amount including delivery charges
    'pid' => $pid,
    'scd' => 'EPAYTEST',
    'su' => 'http://localhost:8080/Plant/success.php?q=su',
    'fu' => 'http://localhost:8080/Plant/failed.phpq?=fu'
];

// Send payment request to Esewa
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

if ($response === false) {
    // Handle cURL error
    echo "Error communicating with Esewa: " . curl_error($curl);
    curl_close($curl);
    exit();
}

curl_close($curl);

// Redirect to Esewa payment page
header("Location: https://uat.esewa.com.np/epay/main?" . http_build_query($data));
exit();
?>
