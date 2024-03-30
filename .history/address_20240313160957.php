<?php require "./includes/conn.php"; ?>

<?php
$fullName = $phoneNumber = $email = $address = $city = $district = $postcode = $country = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['name'];
    $phoneNumber = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $postcode = $_POST['zip'];
    $country = $_POST['country'];

    $query = "INSERT INTO `customers`(`full_name`, `phone_number`, `email`, `address`, `city`, `district`, `postcode`, `country`)
    VALUES ('$fullName','$phoneNumber','$email','$address','$city','$district','$postcode','$country')";

    if (mysqli_query($con, $query)) {
        echo "Inserted";
        header("Location: https://uat.esewa.com.np/epay#/");
        exit; // Make sure to exit after redirecting
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
