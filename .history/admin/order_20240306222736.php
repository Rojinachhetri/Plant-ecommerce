<?php
require 'includes/conn.php';

session_start();

if (!isset($_SESSION['admin_email'])) {
    echo "<script> location.href='/Plant/admin/login.php'; </script>";
    exit();
}
require "includes/header.php";
?>
<div class="mainContainer">
    <?php require "includes/sidebar.php" ?>


    <div class="allContainer">
        <div class="container jumbotron jumbotron-fluid col-md-6 bg-light my-4 p-4 text-center">
            <div class="container">
                <h1 class="display-4">Customer Orders</h1>
            </div>
        </div>

        <div class="container">
            <table class="table container">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Id</th>
                        <th scope="col">Customer Address</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Order Status</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php require "includes/conn.php" ?>
                    <?php
                    $query = 'SELECT orders.id, orders.order_date, orders.product_id, orders.status, orders.user_id, orders.order_amount, products.title, products.image, users.first_name, users.last_name, customers.address FROM `orders` 
                    INNER JOIN `products` ON orders.product_id = products.id 
                    INNER JOIN `users` ON orders.user_id = users.id
                    INNER JOIN `customers` ON customers.id = customers.customers_id
                    ORDER BY id';

                    $result = mysqli_query($conn, $query);
                    
if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result)) {
    // Process fetched data
}


                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['order_date'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td><img class='adminimg' src='../img/product/" . $row['image'] . "' /></td>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $row['first_name'] ." " .$row['last_name']. "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>Rs. " . $row['order_amount'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td colspan='2'>
                                <a href='scripts/order_shipped.php?id=".$row['id']."'><button class='btn btn-success'>Shipped</button></a>
                                <a href='scripts/order_delivered.php?id=".$row['id']."'><button class='btn btn-success'>Delivered</button></a>
                            </td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
