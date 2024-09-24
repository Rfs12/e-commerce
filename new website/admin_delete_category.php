<?php
include('connect.php');

// Ensure that id is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete products associated with the category
        $stmt = $conn->prepare("DELETE FROM products WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $stmt->close();

        // Delete the category
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $stmt->close();

        // Commit the transaction
        $conn->commit();
        echo "<script>
        alert('category deleted successfully');
        window.location.href = 'admin_categories.php';
      </script>";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();

        echo "Error deleting category: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid category ID.";
}
