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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>esewa</title>
</head>
<body>
<form action="https://uat.esewa.com.np/epay/main" method="POST">
    <input value="100" name="tAmt" type="hidden">
    <input value="90" name="amt" type="hidden">
    <input value="100" name="txAmt" type="hidden">
    <input value="2" name="psc" type="hidden">
    <input value="3" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">
    <input value="http://merchant.com.np/page/esewa_payment_success?q=su" type="hidden" name="su">
    <input value="http://merchant.com.np/page/esewa_payment_failed?q=fu" type="hidden" name="fu">
    <input value="Submit" type="submit">
    </form>
</body>
</html>

// Define Esewa payment parameters
// $url = "https://uat.esewa.com.np/epay/main";
// $data = [
//     'amt' => $amt,
//     'pdc' => $pdc,
//     'psc' => 0,
//     'txAmt' => 0,
//     'tAmt' => $total_amount,
//     'pid' => $pid,
//     'scd' => 'EPAYTEST',
//     'su' => 'http://localhost:8080/Plant/success.php',
//     'fu' => 'http://localhost:8080/Plant/failure.php'
// ];

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// $response = curl_exec($curl);
// curl_close($curl);

// // Redirect to Esewa payment page
// header("Location: https://uat.esewa.com.np/epay/main?" . http_build_query($data));
// exit();
// ?>
