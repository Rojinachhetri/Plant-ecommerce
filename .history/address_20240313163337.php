<?php
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

    // Insert data into the 'customers' table
    $query = "INSERT INTO `customers`(`full_name`, `phone_number`, `email`, `address`, `city`, `district`, `postcode`, `country`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, "ssssssss", $fullName, $phoneNumber, $email, $address, $city, $district, $postcode, $country);
    if (mysqli_stmt_execute($statement)) {
        // Data inserted successfully, redirect to the payment page or any other page
        header("Location: https://uat.esewa.com.np/epay#/");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
    mysqli_stmt_close($statement);
}
?>
