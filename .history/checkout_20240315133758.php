<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .text-danger {
        color: red;
    }
    </style>
</head>
<body>
    
<?php
session_start();
require './includes/conn.php';
require "./includes/head.php";

// Server-side validation function
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!isset($_SESSION['email'])) {
    header("Location: /Plant");
    exit();
}

// Calculate the total amount and quantity of products in the cart
$user_id = $_SESSION['user_id'];
$query = "SELECT products.id, products.title, cart.qty, products.price FROM cart JOIN products ON products.id = cart.product_id WHERE cart.user_id = ?";
$statement = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($statement, "i", $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$data = [];
$sum = $quantity = 0;
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
    $sum += $row['qty'] * $row['price'];
    $quantity += $row['qty'];
}
$delivery_charge = $quantity * 49; // Calculate the total delivery charge for all products
$tAmt = $sum + $delivery_charge; // Calculate the total amount including delivery charges
mysqli_stmt_close($statement);

// Server-side form validation
$nameErr = $numberErr = $emailErr = "";
$name = $number = $email = $address = $city = $district = $zip = $country = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validateInput($_POST["name"]);
    $number = validateInput($_POST["number"]);
    $email = validateInput($_POST["email"]);
    $address = validateInput($_POST["address"]);
    $city = validateInput($_POST["city"]);
    $district = validateInput($_POST["district"]);
    $zip = validateInput($_POST["zip"]);
    $country = validateInput($_POST["country"]);

    // Regular expressions for email and phone number validation
    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    $phoneRegex = '/^\d{10}$/';

    // Check if any field is empty
    if (empty($name)) {
        $nameErr = "Name is required";
    }
    if (empty($number)) {
        $numberErr = "Phone number is required";
    } elseif (!preg_match($phoneRegex, $number)) {
        $numberErr = "Invalid phone number (10 digits only)";
    }
    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!preg_match($emailRegex, $email)) {
        $emailErr = "Invalid email format";
    }
}
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
            <div class="col-lg-8">
                <div class="billing_details">
                    <h3>Billing/Shipping Details</h3>
                    <form class="contact_form" id="checkoutForm" action="address.php" method="post" >
                        <!-- Billing/Shipping form fields -->
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" placeholder="First name" />
                                <small class="text-danger"><?php echo $nameErr; ?></small> <!-- Error message for name -->
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="number" placeholder="Phone number" />
                                <small class="text-danger"><?php echo $numberErr; ?></small> <!-- Error message for phone number -->
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" />
                                <small class="text-danger"><?php echo $emailErr; ?></small> <!-- Error message for email -->
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
                        <div id="checkout_form">
                        <input type="hidden" name="payment_method" id="payment_method" value="">
                        <button onclick="Echeckout()" name="checkoutEsewa"  class="btn_1">Pay with esewa</button>
                        <button onclick="checkout()" name="checkoutCashOnDelivery" class="btn_1">Cash on delivery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function Echeckout() {
        document.getElementById("payment_method").value = "checkoutEsewa";
        document.getElementById("checkout_form").submit(); // Submit the form after setting the value
    }

    function checkout() {
        document.getElementById("payment_method").value = "checkoutCashOnDelivery";
        document.getElementById("checkout_form").submit(); // Submit the form after setting the value
    }
</script>

<?php require './includes/footer.php'; ?>

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

<script>
    // Client-side validation
    function validateForm() {
        var firstName = document.getElementById('first').value;
        var phoneNumber = document.getElementById('number').value;
        var email = document.getElementById('email').value;
        var address = document.getElementById('add1').value;
        var city = document.getElementById('city').value;
        var district = document.getElementById('district').value;
        var zip = document.getElementById('zip').value;
        var country = document.getElementById('country').value;

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var phoneRegex = /^\d{10}$/;
        var emailError = document.getElementById('emailError');
        var phoneError = document.getElementById('phoneError');

        if (firstName === '' || phoneNumber === '' || email === '' || address === '' || city === '' || district === '' || zip === '' || country === '') {
            alert('All fields are required!');
            return false;
        }
        if (!emailRegex.test(email)) {
            emailError.innerText = 'Please enter a valid email address!';
            return false;
        }
        if (!phoneRegex.test(phoneNumber)) {
            phoneError.innerText = 'Please enter a valid phone number (10 digits only)!';
            return false;
        }
        return true;
    }

    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
</script>
<script>
    function checkout(paymentMethod) {
    if (!validateForm()) {
        return; // Don't proceed if form validation fails
    }

    // AJAX request to handle the checkout process based on the selected payment method
    // var xhr = new XMLHttpRequest();
    // xhr.open("POST", "address.php", true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //         // Handle the response based on the payment method
    //         if (paymentMethod === 'checkoutEsewa') {
    //             // Redirect or handle Esewa integration
    //         } else if (paymentMethod === 'checkoutCashOnDelivery') {
    //             // Redirect to confirmation page
    //             window.location.href = 'confirmation.php';
    //         }
    //     }
    // };

    // Serialize form data
    var formData = new FormData(document.getElementById("checkoutForm"));
    formData.append('payment_method', paymentMethod);

    // Send the form data
    xhr.send(formData);
}

</script>

</body>
</html>
