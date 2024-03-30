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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Adjust the path based on your file structure -->
</head>
<body>
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Search Results</h2>
                        <p>Showing results for: <?php echo $search_query; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cat_product_area section_padding">
    <div class="container">
        <div class="row">
<?php
        // Display the products found
        while($row = mysqli_fetch_assoc($search_result)) {
?>
            <div class="col-lg-4 col-sm-6">
                <div class="single_product_item">
                    <img src="img/product/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" />
                    <div class="single_product_text">
                        <h4><?php echo $row['title']; ?></h4>
                        <h3>Rs. <?php echo $row['price']; ?></h3>
<?php
            // Check if the product is added to cart
            if(!check_if_added_to_cart($row['id'])) {
?>
                        <a href="scripts/cart_add.php?id=<?php echo $row['id']; ?>&qty=1" class="add_cart">+ add to cart<i class="ti-heart"></i></a>
<?php
            } else {
?>
                        <a href="#" class="add_cart" disabled>+ add to cart<i class="ti-heart"></i></a>
<?php
            }
?>
                    </div>
                </div>
            </div>
<?php
        }
?>
        </div>
    </div>
</section>

<?php require './includes/footer.php'; ?>

<script src="js/jquery-1.12.1.min.js"></script>
<!-- Include other scripts as needed -->
</body>
</html>
<?php
    } else {
        // No products found message
        echo 'No products found matching your search.';
    }
} else {
    // Redirect or display error if no search query is provided
    echo 'Please enter a search query.';
}
?>

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
