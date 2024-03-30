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
if ($result) {
  while ($row = mysqli_fetch_array($result)) {
      // Process rows
  }
} else {
  echo "No results found in the cart.";
}
// Initialize variables for total amount and bill HTML
$total_amount = 0;
$bill_html = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];

    if ($result) {
        // Start building the bill HTML
        $bill_html .= '<h3>Bill Details</h3><table class="table table-borderless"><thead><tr><th scope="col">Product ID</th><th scope="col">Product Name</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">Amount</th></tr></thead><tbody>';

        while ($row = mysqli_fetch_array($result)) {
            $order_amount = $row['price'] * $row['qty'] + 49;
            $total_amount += $order_amount; // Calculate total amount

            // Add product details to the bill HTML
            $bill_html .= '<tr><td>' . $row['id'] . '</td><td>' . $row['title'] . '</td><td>' . $row['price'] . '</td><td>' . $row['qty'] . '</td><td>' . $order_amount . '</td></tr>';
        }

        $bill_html .= '</tbody></table>';
        $bill_html .= '<h3>Total Amount: ' . $total_amount . '</h3>';
    } else {
        // Error handling for query execution
        echo "Error fetching cart items: " . mysqli_error($con);
    }
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
                        echo $bill_html;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery-1.12.1.min.js"></script>

<script src="js/popper.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.magnific-popup.js"></script>

<script src="js/swiper.min.js"></script>

<script src="js/masonry.pkgd.js"></script>

<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>

<script src="js/slick.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/stellar.js"></script>
<script src="js/price_rangs.js"></script>
    <!-- Include any additional JS scripts your project uses -->
    <script src="js/custom.js"></script>
    <?php require './includes/footer.php'; ?>
</body>

</html>
