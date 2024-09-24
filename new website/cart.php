
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="cart.css" rel="stylesheet">
<link href="button.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
 .footer {
            background-color: #848484;
            color: white;
            padding: 20px 0px;
            text-align: center;
            margin-top: 3vw;
        }
        .footer a {
            color: white;
            margin: 0 1vw;
        }
</style>
</head>
<body>
<?php include('usersidebar.php');?>
<?php
// Database connection parameters
include('connect.php');

// Function to add product to cart
function addToCart($conn, $productId, $productName, $productPrice, $productImg) {
    // Check if the product already exists in the cart
    $checkCart = "SELECT * FROM cart WHERE id = '$productId'";
    $cartResult = $conn->query($checkCart);

    if ($cartResult->num_rows > 0) {
        // If product exists, update the quantity
        $updateCart = "UPDATE cart SET quantity = quantity + 1 WHERE id = '$productId'";
        if ($conn->query($updateCart) === TRUE) {
            echo "Cart updated successfully.";
        } else {
            echo "Error updating cart: " . $conn->error;
        }
    } 
}

// Function to update cart quantity
function updateCartQuantity($conn, $productId, $quantity) {
    $updateQuantity = "UPDATE cart SET quantity = '$quantity' WHERE id = '$productId'";
    if ($conn->query($updateQuantity) === TRUE) {
        echo '<script>
        Swal.fire({
          title: "Good job!",
          text: "You update the quantity from cart!",
          icon: "success"
        });
        </script>
        ';
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
}

// Check if the form is submitted for adding to cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve product details from the form
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productImg = $_POST['img'];

    // Call the function to add to cart
    addToCart($conn, $productId, $productName, $productPrice, $productImg);
}

// Check if the form is submitted for updating cart quantity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
    // Retrieve product id and new quantity from the form
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Call the function to update cart quantity
    updateCartQuantity($conn, $productId, $quantity);
}

// Fetch products from the database

// Function to delete product from cart
function deleteFromCart($conn, $productId) {
    $deleteProduct = "DELETE FROM cart WHERE id = '$productId'";
    if ($conn->query($deleteProduct) === TRUE) {
        echo '
        <script>
        Swal.fire({
          text: "You delete the product from cart!",
          icon: "error"
        });
        </script>
        ';
    } else {
        echo "Error removing product: " . $conn->error;
    }
}

// Check if the form is submitted for deleting a product from the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_from_cart'])) {
    // Retrieve product id from the form
    $productId = $_POST['id'];

    // Call the function to delete from cart
    deleteFromCart($conn, $productId);
}
?>
<h1 class="text-center mt-5">Your Cart</h1>
<div>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
<?php
// Display cart items
$cart_items = mysqli_query($conn, "SELECT * FROM cart");

if ($cart_items) {
    while ($item = mysqli_fetch_assoc($cart_items)) {
        // Get the image path from the item
        $image_paths = explode(',', $item['img']);
        $image_path = $image_paths[0];
        echo "<div class='cart-item'style='width:350px;'>";
        // Display the image using the image path
        echo "<img style='width: 200px;height: 150px;'src='" . $image_path . "' alt='" . $item['name'] . "' class='img-fluid'>";
        echo "<div class='ms-3'>";
        echo "<div>" . $item['name'] . "</div>";
        echo "<div>Rs." . $item['price'] . "</div>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='" . $item['id'] . "'>";
        echo "<input type='number' name='quantity' style='width:90px;' class='form-control' value='" . $item['quantity'] . "' min='1'>";
        echo "<div class='mt-2'>";
        echo "<button type='submit' name='update_quantity' class='btn btn-primary me-2'><i style='font-size:24px' class='fa'>&#xf044;</i></button>";
        echo "<button type='submit' name='delete_from_cart' onclick='removeFromCart(" . $item['id'] . ")' class='btn btn-danger'><i class='material-icons'>&#xe872;</i></button>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No items in the cart.";
}
?>
</div>
<div class="col-md-6">
<?php
$cartCountQuery = "SELECT SUM(quantity) AS total FROM cart";
$result = $conn->query($cartCountQuery);
$cartCount = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cartCount = $row["total"];
}
// Display cart items
$cart_items = mysqli_query($conn, "SELECT * FROM cart");
$total = 0;
if ($cart_items) {
    echo "<div class='container'>";
    while ($item = mysqli_fetch_assoc($cart_items)) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        echo "<div class='cart-item item'>";
        echo "<div class='name'>" . $item['name'] . "</div>";
        echo "<div>Qty: " . $item['quantity'] . "</div>";
        echo "<div>Subtotal Rs." . number_format($subtotal, 2) . "</div>";
        echo "</div>";
    }
    echo "<div class='subtotal'>Total: Rs." . number_format($total, 2) . "</div>";
  
    if ($cartCount > 0) {
      echo '<form method="post" action="checkout.php">';
     
        echo '<button type="submit"  class="w-100 button">continue to checkout</button>';
        echo '</form>';
        
    } else {
      echo '<form method="post" action="index.php">';
        echo '<button type="submit" class="w-100 button btn-lg text-white">Go To Shop</button>';
        echo '</form>';
    }
  
}

// Close the database connection
$conn->close();
?>
</div>
</div>
</div>
</div>
<!--footer-->
<footer class="footer">
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="facebook" viewBox="0 0 16 16">
    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
  </symbol>
  <symbol id="instagram" viewBox="0 0 16 16">
      <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
  </symbol>
  <symbol id="twitter" viewBox="0 0 16 16">
    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
  </symbol>
</svg>
<div class="b-example-divider"></div>
<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top footer">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary"style="font-size:20px;">&copy; 2024 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
    </ul>
  </div>
</footer> 
<!--remove products from the cart icon and updated function-->
<script>
function removeFromCart(productId) {
    // Make an AJAX request to the server to remove the product from the cart
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'products.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            // Update the cart count in the cart icon
            document.getElementById('cart-count').textContent = this.responseText;
        }
    };
    xhr.send('delete_from_cart=' + productId);
}
</script>
</body>
</html>