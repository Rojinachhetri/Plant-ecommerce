<?php
require 'includes/conn.php';
require 'includes/is_added_to_cart.php';
session_start();
require "./includes/head.php";

// Fetch all products initially
$query = 'SELECT * FROM `products`';
$result = mysqli_query($con, $query);

$sum = mysqli_num_rows($result); // Get the total number of products

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
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

<section class="cat_product_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <?php
                                // Fetch categories from your database dynamically
                                $category_query = "SELECT * FROM category";
                                $category_result = mysqli_query($con, $category_query);
                                while ($category = mysqli_fetch_assoc($category_result)) {
                                    // Output dynamic category links
                                    echo '<li><a href="?category_id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <div class="single_product_menu">
                                <!-- <p><span><?php echo $sum ?> </span> Product Found</p> -->
                            </div>
                            <div class="single_product_menu d-flex">
                                <h5>show :</h5>
                                <div class="top_pageniation">
                                    <ul>
                                        <li>1</li>
                                        <li>2</li>
                                        <li>3</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single_product_menu d-flex">
                                <form action="search.php" method="GET" class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Search for products" aria-describedby="inputGroupPrepend" />
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn-3" id="inputGroupPrepend">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center latest_product_inner">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="col-lg-4 col-sm-6">
                                <div class="single_product_item">
                                    <img width="200px" src="img/product/' . $row['image'] . '" alt="' . $row['title'] . '" />
                                    <div class="single_product_text">
                                        <h4>' . $row['title'] . '</h4>
                                        <h3>Rs. ' . $row['price'] . '</h3>';
                        if (!check_if_added_to_cart($row['id'])) {
                            echo '<a href="scripts/cart_add.php?id=' . $row['id'] . '&qty=1" class="add_cart">+ add to cart<i class="ti-heart"></i></a>';
                        } else {
                            echo '<a href="#" class="add_cart" disabled>+ add to cart<i class="ti-heart"></i></a>';
                        }

                        echo ' </div>
                                </div>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require './includes/footer.php' ?>

<script src="js/jquery-1.12.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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
    $(document).ready(function () {
        // Handle category link clicks
        $('.list a').click(function (e) {
            e.preventDefault(); // Prevent default link behavior

            var categoryID = $(this).attr('href').split('=')[1]; // Get the category ID from the link

            // AJAX call to fetch products of the selected category
            $.ajax({
                type: 'POST',
                url: 'get_products_by_category.php', // Create this PHP file to handle AJAX request
                data: { category_id: categoryID },
                success: function (response) {
                    // Update product listing with the filtered products
                    $('.latest_product_inner').html(response);
                },
                error: function () {
                    console.log('Error fetching products.');
                }
            });
        });
    });
</script>

</body>
</html>
