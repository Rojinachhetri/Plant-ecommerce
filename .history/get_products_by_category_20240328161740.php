<?php
// Include database connection and other necessary files
require 'includes/conn.php';

if (isset($_POST['category_id'])) {
    $categoryID = mysqli_real_escape_string($con, $_POST['category_id']);

    // Fetch products of the selected category
    $products_query = "SELECT * FROM products WHERE category_id = '$categoryID'";
    $products_result = mysqli_query($con, $products_query);

    // Display products
    while ($product = mysqli_fetch_assoc($products_result)) {
        // Output product details (similar to your existing product display code)
        echo '<div class="col-lg-4 col-sm-6">
            <div class="single_product_item">
                <img width="200px" src="img/product/' . $product['image'] . '" alt="' . $product['title'] . '" />
                <div class="single_product_text">
                    <h4>' . $product['title'] . '</h4>
                    <h3>Rs. ' . $product['price'] . '</h3>';
                    // Add to cart button or other actions
                    echo '<a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a>';
                echo '</div>
            </div>
        </div>';
    }
} else {
    // Handle if no category ID is provided
    echo 'No category selected.';
}
?>
