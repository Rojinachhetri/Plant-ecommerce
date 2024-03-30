<?php
session_start();
require "./includes/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['name'];
    $phoneNumber = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $postcode = $_POST['zip'];
    $country = $_POST['country'];
    $paymentMethod = $_POST['payment_method'];

    // Insert data into the 'customers' table
    $query = "INSERT INTO `customers`(`full_name`, `phone_number`, `email`, `address`, `city`, `district`, `postcode`, `country`.`paymentMethod`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, "ssssssss", $fullName, $phoneNumber, $email, $address, $city, $district, $postcode, $country);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    // Depending on the payment method, perform appropriate actions
    if ($paymentMethod === 'checkoutCashOnDelivery') {
        // Insert order details with payment method as "Cash on Delivery"
        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit;
    } elseif ($paymentMethod === 'checkoutEsewa') {
        // Handle payment with Esewa
        // Add your code for handling payment with Esewa here
    }
}


?>
