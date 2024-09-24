<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Manage Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"href="button.css">
</head>
<body>

<div class="container">
    <?php
    // Check if customer ID is set in the URL
    if (isset($_GET['id'])) {
        $customer_id = $_GET['id'];

        // Fetch customer details
        $customer_query = mysqli_query($conn, "SELECT * FROM customer WHERE id = '$customer_id'");
        if ($customer_query && mysqli_num_rows($customer_query) > 0) {
            $customer_data = mysqli_fetch_assoc($customer_query);

            echo "<h1><strong> Order date&time:</strong> " . htmlspecialchars($customer_data['order_date']) . "</h1>";

            // Display customer information
            echo "<h2>Customer Information</h2>";
            echo "<h5><strong>Name:</strong> " . htmlspecialchars($customer_data['customer_name']) . "</h5>";
            echo "<h5><strong>Email:</strong> " . htmlspecialchars($customer_data['email']) . "</h5>";
            echo "<h5><strong>Phone Number:</strong> " . htmlspecialchars($customer_data['phone_number']) . "</h5>";
            echo "<h5><strong>Address:</strong> " . htmlspecialchars($customer_data['address']) . "</h5>";
            echo "<h5><strong>City:</strong> " . htmlspecialchars($customer_data['city']) . "</h5>";
            echo "<h5><strong>District:</strong> " . htmlspecialchars($customer_data['district']) . "</h5>";
            echo "<h5><strong>Postal Code:</strong> " . htmlspecialchars($customer_data['postal_code']) . "</h5>";

            // Decode JSON data from total_products column
            $ordered_products = json_decode($customer_data['total_products'], true);

            if (!empty($ordered_products)) {
                echo "<h2>Ordered Products</h2>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Product Name</th>";
                echo "<th>Quantity</th>";
                echo "<th>Price</th>";
                echo "<th>Subtotal</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // Initialize total order amount
                $total_order_amount = 0;

                // Iterate through each product in the ordered_products array
                foreach ($ordered_products as $product) {
                    $product_name = htmlspecialchars($product['name']);
                    $quantity = intval($product['quantity']); // Convert quantity to integer
                    $price = floatval($product['price']); // Convert price to float

                    // Calculate subtotal for the current product
                    $subtotal = $price * $quantity;

                    // Add subtotal to total order amount
                    $total_order_amount += $subtotal;

                    // Display the product details in table rows
                    echo "<tr>";
                    echo "<td>" . $product_name . "</td>";
                    echo "<td>" . $quantity . "</td>";
                    echo "<td>Rs." . number_format($price, 2) . "</td>";
                    echo "<td>Rs." . number_format($subtotal, 2) . "</td>";
                    echo "</tr>";
                }

                // Display total order amount row
                echo "<tr>";
                echo "<td colspan='3' class='text-right'><strong>Total Order Amount</strong></td>";
                echo "<td>Rs." . number_format($total_order_amount, 2) . "</td>";
                echo "</tr>";

                echo "</tbody>";
                echo "</table>";
                echo "</div>"; // Close table-responsive
            } else {
                echo "<p>No products ordered.</p>";
            }

            // Display a button to go back to the customer list
            echo "<a href='admin_manage_orders.php' class='btn button' >Back to Customer List</a>";
            echo "<td><a href='mark_delivered.php?id=" . $customer_data['id'] . "' class='btn button'style='margin-left:2rem;'>Mark as Delivered</a></td>";

        } else {
            echo "<p>No customer found with ID: " . htmlspecialchars($customer_id) . "</p>";
        }
    } else {
        echo "<p>Customer ID is not set.</p>";
    }
    ?>
</div>

</body>
</html>
