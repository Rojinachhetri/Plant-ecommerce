<?php
// Include your database connection file
require 'includes/conn.php';
require 'includes/is_added_to_cart.php';
session_start();
require "./includes/head.php";

// Check if the search query parameter is set in the URL
if(isset($_GET['query'])) {
    // Sanitize and store the search query
    $search_query = mysqli_real_escape_string($con, $_GET['query']);

    // Perform a database query to search for products based on the search query
    $search_sql = "SELECT * FROM products WHERE title LIKE '%$search_query%'";
    $search_result = mysqli_query($con, $search_sql);

    // Check if there are any products found
    if(mysqli_num_rows($search_result) > 0) {
        // Display the products found
        while($row = mysqli_fetch_assoc($search_result)) {
            // Output product details
            echo '<div class="product_item">';
            echo '<h3>' . $row['title'] . '</h3>';
            
            // Check if 'description' key exists in the array
            if(isset($row['description'])) {
                echo '<p>' . $row['description'] . '</p>';
            } else {
                echo '<p>No description available</p>';
            }
            
            echo '<span>Price: ' . $row['price'] . '</span>';
            echo '</div>';
        }
    } else {
        // No products found message
        echo 'No products found matching your search.';
    }
} else {
    // Redirect or display error if no search query is provided
    echo 'Please enter a search query.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>All Products</h2>
                        <p>Home <span>-</span> Buy Products</p>
                    </div>
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
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7721ac04f8bd3390","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>
</body>

</html>