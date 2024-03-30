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
    
    // Check which payment method was selected
    if (isset($_POST['checkoutCashOnDelivery'])) {
        $paymentMethod = 'checkoutCashOnDelivery';
    } elseif (isset($_POST['checkoutEsewa'])) {
        $paymentMethod = 'checkoutEsewa';
    } else {
        // Default payment method if none selected (you can handle this case as needed)
        $paymentMethod = '';
    }

    // Insert data into the 'customers' table
    $query = "INSERT INTO `customers`(`full_name`, `phone_number`, `email`, `address`, `city`, `district`, `postcode`, `country`, `payment_method`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, "sssssssss", $fullName, $phoneNumber, $email, $address, $city, $district, $postcode, $country, $paymentMethod);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    // Depending on the payment method, perform appropriate actions
    if ($paymentMethod === 'checkoutCashOnDelivery') {
        // Insert order details with payment method as "Cash on Delivery"
        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit;
    } elseif ($paymentMethod === 'checkoutEsewa') {
        header("Location:https://uat.esewa.com.np/epay/main/#"); // Example URL for Esewa payment page
        exit;
    }
}
?>
