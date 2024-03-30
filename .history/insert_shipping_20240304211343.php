<?php
session_start();
require './includes/conn.php'; // Assuming this file contains your database connection
// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['compemailany'];
    $address = $_POST['add1'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    // SQL query to insert data into the shipping table
    $sql = "INSERT INTO customers (name, number, email, address, city, district, zip, country)
            VALUES ('$name', '$number', '$email', '$address', '$city', '$district', '$zip', '$country')";
    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Data inserted successfully
        echo "success";
    } else {
        // Error inserting data
        echo "error";
    }
} else {
    // If the form data is not submitted via POST method, redirect or handle the error accordingly
    echo "Form data not submitted";
}
?>
