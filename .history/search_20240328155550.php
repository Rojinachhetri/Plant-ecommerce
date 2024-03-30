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
