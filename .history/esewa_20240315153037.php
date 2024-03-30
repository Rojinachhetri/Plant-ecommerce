<?php
session_start();
require './includes/conn.php';

if (!isset($_SESSION['email'])) {
    header("Location: /Plant");
    exit();
}

$amt = 0; // Initialize amount variable
$pid = 'user_id'; // Initialize pid variable

// Calculate the delivery charge (Rs. 49 per product)
$delivery_charge = $quantity * 49;

// Calculate the total amount including the delivery charge
$total_amount = $amt + $delivery_charge;

// Set the variables required for Esewa payment
$pdc = $delivery_charge; // Product Delivery Charge
$pid = 'ORDER_ID_' . uniqid(); // Generate a unique Payment ID

// Calculate the total amount and generate a unique order ID
$user_id = $_SESSION['user_id'];
$query = 'SELECT products.price, products.id, cart.qty from cart, products where products.id = cart.product_id and cart.user_id="' . $user_id . '"';
$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $amt += $row['price'] * $row['qty']; // Calculate total amount
    }
    $pid = 'ORDER_ID_' . $user_id . '_' . time(); // Generate a unique order ID
} else {
    // Error handling for query execution
    echo "Error fetching cart items: " . mysqli_error($con);
}

// Define Esewa payment parameters
$url = "https://uat.esewa.com.np/epay/main";
$data = [
    'amt' => $amt,
    'pdc' => $pdc,
    'psc' => 0,
    'txAmt' => 0,
    'tAmt' => $total_amount,
    'pid' => $pid,
    'scd' => 'EPAYTEST',
    'su' => 'http://localhost:8080/Plant/success.php',
    'fu' => 'http://localhost:8080/Plant/failure.php'
];

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Redirect to Esewa payment page
header("Location: https://uat.esewa.com.np/epay/main?" . http_build_query($data));
exit();
?>
