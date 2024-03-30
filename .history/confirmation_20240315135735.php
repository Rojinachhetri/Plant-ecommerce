<?php
session_start();
require "./includes/head.php";
require './includes/conn.php';

// Initialize $bill_html variable
$bill_html = '';

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email'])) {
    echo "<script> location.href='/Plant'; </script>";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];

    // Fetch products and quantities from the cart
    $query = 'SELECT products.price, products.id, products.title, products.image, cart.qty from cart, products where products.id = cart.product_id and cart.user_id="' . $user_id . '"';
    $result = mysqli_query($con, $query);

    if ($result) {
        if ($payment_method == "checkoutCashOnDelivery") {
            // Insert order details with payment method as "Cash on Delivery"
            $total_amount = 0; // Initialize total amount
            $bill_html = '<h3>Bill Details</h3><table class="table table-borderless"><thead><tr><th scope="col">Product ID</th><th scope="col">Product Name</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">Amount</th></tr></thead><tbody>';

            while ($row = mysqli_fetch_array($result)) {
                $order_amount = $row['price'] * $row['qty'] + 49;

                // Prepare the INSERT query with placeholders
                $order = "INSERT INTO `orders`(`product_id`, `user_id`, `product_qty`, `order_amount`, `status`, `payment`) 
                          VALUES (?, ?, ?, ?, 'Confirmed', 'Cash on Delivery')";
                $statement = mysqli_prepare($con, $order);

                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($statement, "iiids", $row['id'], $user_id, $row['qty'], $order_amount, $payment_method);
                mysqli_stmt_execute($statement);

                // Check for successful execution
                if (mysqli_stmt_affected_rows($statement) > 0) {
                    // Order inserted successfully
                    $total_amount += $order_amount; // Add to total amount
                    $bill_html .= '<tr><td>' . $row['id'] . '</td><td>' . $row['title'] . '</td><td>' . $row['price'] . '</td><td>' . $row['qty'] . '</td><td>' . $order_amount . '</td></tr>';
                } else {
                    // Error handling for failed insertion
                    echo "Error inserting order: " . mysqli_error($con);
                }
                mysqli_stmt_close($statement);

                // Delete item from cart
                $delete_from_cart = "DELETE FROM cart WHERE cart.user_id='$user_id' AND cart.product_id=" . $row['id'];
                mysqli_query($con, $delete_from_cart);

                // Update product quantity
                $decrease_qty = "UPDATE products SET qty = qty - " . $row['qty'] . " WHERE id=" . $row['id'];
                mysqli_query($con, $decrease_qty);
            }

            $bill_html .= '</tbody></table>';
            $bill_html .= '<h3>Total Amount: ' . $total_amount . '</h3>';
        } elseif ($payment_method == "checkoutEsewa") {
            // Handle payment with Esewa
            // Your Esewa payment handling code goes here
        }
    } else {
        // Error handling for query execution
        echo "Error fetching cart items: " . mysqli_error($con);
    }
}
?>

<!-- HTML code for the confirmation page -->
<section class="breadcrumb breadcrumb_bg">
    <!-- Your breadcrumb section HTML -->
</section>

<section class="confirmation_part padding_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="confirmation_tittle">
                    <h1><span>Thank you. Your order has been received.</span></h1>
                </div>
            </div>
            <?php
            // Display the bill details here
            echo '<div class="col-lg-12">
                    <div class="order_details_iner">
                        ' . $bill_html . '
                    </div>
                </div>';
            ?>
        </div>
    </div>
</section>

<?php require './includes/footer.php' ?>
<script src="js/jquery-1.12.1.min.js"></script>
<!-- Include other JS libraries and scripts as needed -->
</body>
</html>
