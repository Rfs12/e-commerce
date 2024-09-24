<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<?php
include('connect.php');

// Ensure that id is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];


    // SQL to delete a record
    $sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product deleted successfully');</script>";
        // Redirect to the page showing products after deletion
       header('location:admin_dashborad.php');
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid product ID.";
}
