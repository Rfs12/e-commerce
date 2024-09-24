<?php
include('connect.php'); // Include database connection file

// Fetch and return the cart count from the database
$cartCountQuery = "SELECT SUM(quantity) AS total FROM cart";
$result = $conn->query($cartCountQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["total"];
} else {
    echo "0";
}

// Close the database connection
$conn->close();
