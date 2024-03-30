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
        header("Location:https://rc-epay.esewa.com.np/api/epay/main/v2/form"); // Example URL for Esewa payment page
        exit;
    }
}

$s = hash_hmac('sha256', 'Message', 'secret', true);
echo base64_encode($s); 
{
    "amount": "100",
    "failure_url": "https://google.com",
    "product_delivery_charge": "0",
    "product_service_charge": "0",
    "product_code": "EPAYTEST",
    "signature": "YVweM7CgAtZW5tRKica/BIeYFvpSj09AaInsulqNKHk=",
    "signed_field_names": "total_amount,transaction_uuid,product_code",
    "success_url": "https://esewa.com.np",
    "tax_amount": "10",
    "total_amount": "110",
    "transaction_uuid": "ab14a8f2b02c3"
    }

?>
