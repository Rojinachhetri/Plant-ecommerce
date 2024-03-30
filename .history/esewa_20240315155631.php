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
$query = "SELECT products.id, products.title, cart.qty, products.price FROM cart JOIN products ON products.id = cart.product_id WHERE cart.user_id = ?";
$statement = mysqli_prepare($con, $query);
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
$delivery_charge = $quantity * 49; // Calculate the total delivery charge for all products
$tAmt = $sum + $delivery_charge; // Calculate the total amount including delivery charges
mysqli_stmt_close($statement);
?>
<?php
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
