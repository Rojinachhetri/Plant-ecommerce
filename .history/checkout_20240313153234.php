<?php
session_start();
require './includes/conn.php';
require "./includes/head.php";

// Check if user is logged in, otherwise redirect to homepage
if (!isset($_SESSION['email'])) {
  echo "<script> location.href='/Plant'; </script>";
  exit();
}

// Initialize total sum and quantity variables
$sum = 0;
$quantity = 0;
$user_id = $_SESSION['user_id'];

// Fetch cart items and calculate total amount
$query = 'SELECT products.price, products.id, products.title, products.image, cart.qty 
          FROM cart
          INNER JOIN products ON products.id = cart.product_id
          WHERE cart.user_id = ?';
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_array($result)) {
  $item_total = $row['qty'] * $row['price'];
  $sum += $item_total;
  $quantity += $row['qty'];
}

// Calculate total amount including shipping
$total_amount = $sum + 49 * $quantity;

// Prepare data for eSewa payment
$url = "https://uat.esewa.com.np/epay/main";
$data = [
    'amt' => $total_amount,
    'pdc' => 0,
    'psc' => 0,
    'txAmt' => 0,
    'tAmt' => $total_amount,
    'pid' => 'product.id', // Check if this is correct or should be replaced with actual product ID
    'scd' => 'EPAYTEST',
    'su' => 'http://localhost:8080/Plant/confirmation.php?q=su',
    'fu' => 'http://merchant.com.np/page/esewa_payment_failed?q=fu'
];

// Convert the array to query string
$data_string = http_build_query($data);

// Initiate cURL request to eSewa
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
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
            <li>
              <a href="#">Product
                <span>Total</span>
              </a>
            </li>
            <?php
            $sum = 0;
            $quantity = 0;
            $user_id = $_SESSION['user_id'];
            $query = 'SELECT products.price, products.id, products.title, products.image, cart.qty from cart, products where products.id = cart.product_id and cart.user_id="' . $user_id . '"';
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
              echo
                '<li>
                <a href="#">
                  ' . $row['title'] . '
                  <span class="middle">x ' . $row['qty'] . '</span>
                  <span class="last">Rs. ' . $row['qty'] * $row['price'] . '</span>
                </a>
              </li>';
              $sum = $sum + $row['qty'] * $row['price'];
              $quantity = $quantity + $row['qty'];
            }
            ?>
          </ul>
          <ul class="list list_2">
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
            <div class="form-group">
    <form action="https://uat.esewa.com.np/epay/main" method="POST">
        <input value="<?php echo $data['tAmt']; ?>" name="tAmt" type="hidden">
        <input value="<?php echo $data['amt']; ?>" name="amt" type="hidden">
        <input value="<?php echo $data['txAmt']; ?>" name="txAmt" type="hidden">
        <input value="<?php echo $data['psc']; ?>" name="psc" type="hidden">
        <input value="<?php echo $data['pdc']; ?>" name="pdc" type="hidden">
        <input value="<?php echo $data['scd']; ?>" name="scd" type="hidden">
        <input value="<?php echo $data['pid']; ?>" name="pid" type="hidden">
        <input value="<?php echo $data['su']; ?>" type="hidden" name="su">
        <input value="<?php echo $data['fu']; ?>" type="hidden" name="fu">
        <input value="Submit"class="btn-2" type="submit">
    </form>
</div>



            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require "./includes/footer.php"; ?>

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
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7721ac1e78ae3390","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>
</body>
</html>