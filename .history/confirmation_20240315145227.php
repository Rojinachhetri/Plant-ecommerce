<?php
session_start();
require "./includes/head.php";
require './includes/conn.php';

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: /Plant");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch products and quantities from the cart
$query = 'SELECT products.price, products.id, products.title, cart.qty FROM cart JOIN products ON products.id = cart.product_id WHERE cart.user_id="' . $user_id . '"';
$result = mysqli_query($con, $query);

// Initialize variables for total amount
$total_amount = 0;

// Process orders and update product quantities
while ($row = mysqli_fetch_array($result)) {
    // Insert order into orders table
    $order_amount = $row['price'] * $row['qty'] + 49; // Add shipping charge
    $order = "INSERT INTO `orders`(`product_id`, `user_id`, `product_qty`, `order_amount`, `status`) 
        VALUES (" . $row['id'] . "," . $user_id . "," . $row['qty'] . "," . $order_amount . ", 'Confirmed')";
    $answer = mysqli_query($con, $order);

    // Delete item from cart
    $deletefromcart = "DELETE FROM cart WHERE cart.user_id='$user_id'";
    $deleted = mysqli_query($con, $deletefromcart);

    // Decrease product quantity
    $decreaseqty = "UPDATE products SET qty = qty - " . $row['qty'] . " WHERE id=" . $row['id'];
    $ans = mysqli_query($con, $decreaseqty);

    // Calculate total amount for the order
    $total_amount += $order_amount;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Include any additional CSS files your project uses -->
</head>

<body>
    <!-- Breadcrumb section -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Order Confirmation</h2>
                            <p>Home <span>-</span> Order Confirmation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Confirmation details section -->
    <section class="confirmation_part padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="confirmation_tittle">
                        <h1><span>Thank you. Your order has been received.</span></h1>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="order_details_iner">
                        <?php
                        // Display bill HTML here
                        if ($result) {
                            echo '<h3>Bill Details</h3>';
                            echo '<table class="table table-borderless"><thead><tr><th scope="col">Product ID</th><th scope="col">Product Name</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">Amount</th></tr></thead><tbody>';

                            mysqli_data_seek($result, 0); // Reset result pointer

                            while ($row = mysqli_fetch_array($result)) {
                                $order_amount = $row['price'] * $row['qty'] + 49;
                                echo '<tr><td>' . $row['id'] . '</td><td>' . $row['title'] . '</td><td>' . $row['price'] . '</td><td>' . $row['qty'] . '</td><td>' . $order_amount . '</td></tr>';
                            }

                            echo '</tbody></table>';
                            echo '<h3>Total Amount: ' . $total_amount . '</h3>';
                            echo "Shipping charge is added Rs. 49/product)";
                        } else {
                            echo "Error fetching cart items: " . mysqli_error($con);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Include any additional JS scripts your project uses -->
    <script src="js/custom.js"></script>
    <?php require './includes/footer.php'; ?>
</body>

</html>