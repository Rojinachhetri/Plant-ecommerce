<?php
session_start();
require "./includes/head.php";
require './includes/conn.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "<script> location.href='/plant'; </script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Construct the SQL query using a JOIN
$query = "SELECT products.price, products.id, products.title, products.image, cart.qty
          FROM cart
          INNER JOIN products ON products.id = cart.product_id 
          WHERE cart.user_id = '$user_id'";

$result = mysqli_query($con, $query);

if (!$result) {
    die('Error: ' . mysqli_error($con)); // Print error message if query fails
}

while ($row = mysqli_fetch_array($result)) {
    $product_id = mysqli_real_escape_string($con, $row['id']);
    $product_qty = mysqli_real_escape_string($con, $row['qty']);
    $order_amount = ($row['price'] * $row['qty']) + 49;

    // Prepare the customer_id value
    $customer_id = isset($row['customer_id']) ? "'" . mysqli_real_escape_string($con, $row['customer_id']) . "'" : "NULL";

    // Insert order into orders table
    $order_query = "INSERT INTO `orders`(`product_id`, `user_id`, `product_qty`, `order_amount`, `status`, `customer_id`) 
                    VALUES ('$product_id', '$user_id', '$product_qty', '$order_amount', 'Confirmed', $customer_id)";
    $order_result = mysqli_query($con, $order_query);

    if (!$order_result) {
        die('Error: ' . mysqli_error($con)); // Print error message if order insertion fails
    }
}

?>


<section class="breadcrumb breadcrumb_bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="breadcrumb_iner">
          <div class="breadcrumb_iner_item">
            <h2>My Orders</h2>
            <p>Home <span>-</span> All Orders</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="confirmation_part padding_top">
  <div class="container">
    <!-- <div class="row">
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>order info</h4>
          <ul>
            <li>
              <p>order number</p><span>: 60235</span>
            </li>
            <li>
              <p>data</p><span>: Oct 03, 2017</span>
            </li>
            <li>
              <p>total</p><span>: USD 2210</span>
            </li>
            <li>
              <p>mayment methord</p><span>: Check payments</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>Billing Address</h4>
          <ul>
            <li>
              <p>Street</p><span>: 56/8</span>
            </li>
            <li>
              <p>city</p><span>: Los Angeles</span>
            </li>
            <li>
              <p>country</p><span>: United States</span>
            </li>
            <li>
              <p>postcode</p><span>: 36952</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>shipping Address</h4>
          <ul>
            <li>
              <p>Street</p><span>: 56/8</span>
            </li>
            <li>
              <p>city</p><span>: Los Angeles</span>
            </li>
            <li>
              <p>country</p><span>: United States</span>
            </li>
            <li>
              <p>postcode</p><span>: 36952</span>
            </li>
          </ul>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-12">
        <div class="order_details_iner">
          <h3>My Order</h3>
          <br><br>
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col">Order Id</th>
                <th scope="col">Order Date</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Order Total</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $allOrders = "SELECT orders.id, orders.order_date ,products.title, orders.product_qty, orders.order_amount, orders.status, customers.customer_id , customers.full_name from orders, products, customers where user_id='$user_id' and orders.product_id=products.id";
              $orderresult = mysqli_query($con, $allOrders);
              while($row = mysqli_fetch_array($orderresult)){
                echo '<tr>
                        <th><span>'.$row['id'].'</span></th>
                        <th><span>'.$row['order_date'].'</span></th>
                        <th><span>'.$row['title'].'</span></th>
                        <th>'.$row['product_qty'].'</th>
                        <th> <span>Rs. '.$row['order_amount'].'</span></th>
                        <th> <span>'.$row['status'].'</span></th>
                        <th> <span>'.$row['customer_id'].'</span></th>
                        <th> <span>'.$row['full_name'].'</span></th>
                      </tr>';
              }
              ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>


<?php require './includes/footer.php' ?>



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
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7721ac24fb7b3390","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>

</body>
</html>