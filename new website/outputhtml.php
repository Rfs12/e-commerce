<?php
session_start();
include('connect.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $productId = mysqli_real_escape_string($conn, $_POST['id']);
    $productName = mysqli_real_escape_string($conn, $_POST['name']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['price']);
    $productImg = mysqli_real_escape_string($conn, $_POST['img']);
    $productQuantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $cart = &$_SESSION['cart'];
    $productExists = false;

    foreach ($cart as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += $productQuantity;
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $cart[] = array(
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'img' => $productImg,
            'quantity' => $productQuantity
        );
    }

    if ($productExists) {
        $response['status'] = 'exists';
        $response['message'] = 'Product already in cart. Quantity updated.';
    } else {
        $response['status'] = 'success';
        $response['message'] = 'Product added to cart.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

header('Content-Type: application/json');
echo json_encode($response);

