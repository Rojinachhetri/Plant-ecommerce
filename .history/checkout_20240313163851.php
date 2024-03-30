<?php
session_start();
require './includes/conn.php';
require "./includes/head.php";

if (!isset($_SESSION['email'])) {
    header("Location: /Plant");
    exit();
}

// Calculate the total amount and quantity of products in the cart
$user_id = $_SESSION['user_id'];
$query = "SELECT products.price, products.title, cart.qty FROM cart JOIN products ON products.id = cart.product_id WHERE cart.user_id = ?";
$statement = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($statement, "i", $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$sum = $quantity = 0;
while ($row = mysqli_fetch_array($result)) {
    $sum += $row['qty'] * $row['price'];
    $quantity += $row['qty'];
}
mysqli_stmt_close($statement);
?>

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-lg-4">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Product Checkout</h2>
                        <p>Home <span>-</span> Shop Single</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout_area padding_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="order_box">
                    <h2>Your Order</h2>
                    <ul class="list">
                        <!-- Display order details -->
                        <?php
                        $statement = mysqli_prepare($con, $query);
                        mysqli_stmt_bind_param($statement, "i", $user_id);
                        mysqli_stmt_execute($statement);
                        $result = mysqli_stmt_get_result($statement);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<li>
                                    <a href="#">
                                        ' . $row['title'] . '
                                        <span class="middle">x ' . $row['qty'] . '</span>
                                        <span class="last">Rs. ' . $row['qty'] * $row['price'] . '</span>
                                    </a>
                                  </li>';
                        }
                        ?>
                    </ul>
                    <ul class="list list_2">
                        <!-- Display subtotal, shipping cost, and total amount -->
                        <li>
                            <a href="#">Subtotal
                                <span>Rs. <?php echo $sum ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Shipping(Rs. 49/product)
                                <span>Rs. <?php echo $quantity * 49 ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Total
                                <span>Rs. <?php echo $sum + 49 * $quantity ?></span>
                            </a>
                        </li>
                    </ul>
                    <br><br>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="billing_details">
                    <h3>Billing/Shipping Details</h3>
                    <form class="contact_form" action="address.php" method="post" novalidate="novalidate">
                        <!-- Billing/Shipping form fields -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require "./includes/footer.php"; ?>
