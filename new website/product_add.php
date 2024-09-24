<?php
include('connect.php');

if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $product_id = $_POST['id'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_img = $_POST['img'];
    $product_quantity = $_POST['quantity'];

    $existing_product = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$product_id'");
    if (mysqli_num_rows($existing_product) > 0) {
        echo json_encode(['status' => 'exists', 'message' => 'Product is already added. Check the cart.']);
    } else {
        // Insert the product into the cart
        $result = mysqli_query($conn, "INSERT INTO cart (id, name, price, img, quantity) VALUES ('$product_id', '$product_name', '$product_price', '$product_img', '$product_quantity')");

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Product added to cart successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error adding product to cart. Please try again.']);
        }
    }
}

