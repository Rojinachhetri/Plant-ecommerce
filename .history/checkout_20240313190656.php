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
$delivery_charge = $quantity * 49; // Calculate the total delivery charge for all products
$tAmt = $sum + $delivery_charge; // Calculate the total amount including delivery charges
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
                        <div class="row">
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="first" name="name" placeholder="First name" />
              </div>
              
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="number" name="number" placeholder="Phone number" />
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" />
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="add1" name="address" placeholder="Address" />
              </div>
              
              <div class="col-md-4 form-group p_star">
                <input type="text" class="form-control" id="city" name="city" placeholder="Town/City" />
              </div>
              <div class="col-md-4 form-group p_star">
                <input type="text" class="form-control" id="district" name="district" placeholder="District" />
              </div>
              <div class="col-md-4 form-group p_star">
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" />
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="country" name="country" placeholder="Country" />
              </div>
            </div>
            <div class="form-group">
            <form action="https://uat.esewa.com.np/epay/main/" method="POST">
    <input value="<?php echo $tAmt; ?>" name="tAmt" type="hidden">
    <input value="<?php echo $sum;?>" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="<?php echo $delivery_charge;?>" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="<?php echo $user_id;?>" name="pid" type="hidden">

    <input value="http://localhost:8080/Plant/confirmation.php?q=su" type="hidden" name="su">
    <input value="http://localhost:8080/Plant/failed.php?q=fu" type="hidden" name="fu">
    <input value="Pay with esewa" class="btn_1" type="submit">
</form>

   
    </div>
       
    
                    </form>
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
<script src="js/custom.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-23581568-13');
</script>


<?php require "./includes/footer.php"; ?>
</body>
</html>