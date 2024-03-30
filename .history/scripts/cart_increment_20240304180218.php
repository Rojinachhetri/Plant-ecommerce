<?php
session_start();
require '../includes/conn.php';

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    // Retrieve the current quantity from the cart
    $query = "SELECT qty FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];
    
    // Increment the quantity by 1
    $new_qty = $current_qty + 1;

    // Update the quantity in the cart
    $update_query = "UPDATE cart SET qty = '$new_qty' WHERE product_id = '$product_id' AND user_id = '$user_id'";
    mysqli_query($con, $update_query);

    // Redirect back to the cart page
    header("Location: ../cart.php");
    exit();
}
?>
