<?php
session_start();
require "./includes/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['name'];
    $phoneNumber = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $postcode = $_POST['zip'];
    $country = $_POST['country'];
    
    // Check which payment method was selected
    if (isset($_POST['checkoutCashOnDelivery'])) {
        $paymentMethod = 'checkoutCashOnDelivery';
    } elseif (isset($_POST['checkoutEsewa'])) {
        $paymentMethod = 'checkoutEsewa';
     } elseif (isset($_POST['checkoutkhalti'])) {
            $paymentMethod = 'checkoutkhalti';
    } else {
        // Default payment method if none selected (you can handle this case as needed)
        $paymentMethod = '';
    }

    // Insert data into the 'customers' table
    $query = "INSERT INTO `customers`(`full_name`, `phone_number`, `email`, `address`, `city`, `district`, `postcode`, `country`, `payment_method`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, "sssssssss", $fullName, $phoneNumber, $email, $address, $city, $district, $postcode, $country, $paymentMethod);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    // Depending on the payment method, perform appropriate actions
    if ($paymentMethod === 'checkoutCashOnDelivery') {
        // Insert order details with payment method as "Cash on Delivery"
        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit;
    } elseif ($paymentMethod === 'checkoutEsewa') {
        
         header("Location:esewa.php");
        } elseif ($paymentMethod === 'checkoutkhalti') {
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var config = {
                        "publicKey": "your_public_key_here",
                        "productIdentity": "1234567890",
                        "productName": "Dragon",
                        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                        "paymentPreference": [
                            "KHALTI",
                            "EBANKING",
                            "MOBILE_BANKING",
                            "CONNECT_IPS",
                            "SCT"
                        ],
                        "eventHandler": {
                            onSuccess: function (payload) {
                                console.log("Payment successful:", payload);
                            },
                            onError: function (error) {
                                console.log("Payment error:", error);
                            },
                            onClose: function () {
                                console.log("Widget closed");
                            }
                        }
                    };
        
                    var checkout = new KhaltiCheckout(config);
        
                    document.getElementById("payment-button").addEventListener("click", function () {
                        checkout.show({ amount: 1000 }); // Replace 1000 with your actual payment amount in paisa (e.g., Rs. 10.00 would be 1000 paisa)
                    });
                });
            </script>
            
          // Example URL for Esewa payment page
        exit;
    }
}
?>





