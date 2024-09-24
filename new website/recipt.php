<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="button.css">
    <style>
        p{
            font-size: 14px;
        }
        ul{
            font-size: 14px;
        }
    </style>
</head>
<body>

<?php
// Include your database connection
include('connect.php');

if (isset($_GET['order_id'])) {
    // Get the order ID from the URL
    $order_id = $_GET['order_id'];

    // Fetch order details from the database using the order ID
    $order_query = "SELECT * FROM `customer` WHERE id = '$order_id'";
    $order_result = mysqli_query($conn, $order_query);

    if (mysqli_num_rows($order_result) > 0) {
        $order = mysqli_fetch_assoc($order_result);

        // Decode the products JSON
        $products = json_decode($order['total_products'], true);

        // Display the receipt
        echo '<div class="container p-4 border" style="max-width: 600px; background: #f8f9fa;">';
        echo '<h2 class="text-center">Order Receipt</h2>';
        echo '<p>Date: ' . date('Y-m-d') . '</p>';
        echo '<p><strong>Order id:</strong> ' . $order['id'] . '</p>';     
        echo '<p><strong>Customer Name:</strong> ' . $order['customer_name'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $order['email'] . '</p>';
        echo '<p><strong>Phone:</strong> ' . $order['phone_number'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $order['address'] . ', ' . $order['city'] . ', ' . $order['district'] . ', ' . $order['postal_code'] . '</p>';
        
        echo '<h4 class="mt-4">Products:</h4>';
        echo '<ul class="list-group">';
        foreach ($products as $product) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
            echo $product['name'] . ' - Quantity: ' . $product['quantity'];
            echo '<span>Rs.'.number_format($product['total_price'], 2).'</span>';
            echo '</li>';
        }
        echo '</ul>';
        
        echo '<p class="mt-4"><strong>Total Price:</strong> Rs.' .  number_format( $order['total_price']) . '.00</p>';
        echo '<p class="text-center">Thank you for your purchase!</p>';

        // Add a download button
        echo '<div class="text-center"><button id="downloadReceipt" class="button">Download Receipt</button></div>';
        echo '</div>';
    } else {
        echo "<p class='alert alert-warning'>Order not found.</p>";
    }
} else {
    echo "<p class='alert alert-danger'>No order ID provided.</p>";
}
?>
</body>
</html>
<script>
// JavaScript to handle the download
document.getElementById('downloadReceipt').addEventListener('click', function () {
    // Create the receipt content as a string with Bootstrap styling
    var receiptContent = `
        <div class="container p-4 border" style="max-width: 600px; background: #f8f9fa;">
            <h2 class="text-center">Order Receipt</h2>
            <p>Date: <?php echo date('Y-m-d'); ?></p>
            <p><strong>Order Id:</strong> <?php echo $order['id']; ?></p>
            <p><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $order['phone_number']; ?></p>
            <p><strong>Address:</strong> <?php echo $order['address'] . ', ' . $order['city'] . ', ' . $order['district'] . ', ' . $order['postal_code']; ?></p>
            
            <h4 class="mt-4">Products:</h4>
            <ul class="list-group">
                <?php foreach ($products as $product) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $product['name'] . ' - Quantity: ' . $product['quantity']; ?>
                        <span>Rs. <?php echo number_format($product['total_price'], 2); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p class="mt-4"><strong>Total Price:</strong> Rs.<?php echo number_format( $order['total_price']); ?>.00</p>
            <p class="text-center">Thank you for your purchase!</p>
        </div>
    `;

    // Create a blob and trigger the download
    var blob = new Blob([receiptContent], { type: 'text/html' });
    var url = URL.createObjectURL(blob);

    var a = document.createElement('a');
    a.href = url;
    a.download = 'receipt.html';
    document.body.appendChild(a);
    a.click();

    // Clean up
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
});
</script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
