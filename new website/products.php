
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="button.css">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        a {
            text-decoration: none;
            font-size: 25px;
        }
        i {
            margin: 5px;
        }
        select {
            padding-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
include('connect.php');

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];

    // If the product is already in the cart, update the quantity
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        // If the product is not in the cart, add it with the quantity
        $_SESSION['cart'][$productId] = $quantity;
    }
}

// Delete from cart functionality
if (isset($_POST['delete_from_cart'])) {
    $productId = $_POST['delete_from_cart'];

    // Remove the product from the cart
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    // Return the updated cart count
    echo count($_SESSION['cart']);
}
?>
  <div id="products-section">
<hr>
<h2>Our Products</h2>
</hr>
<div class="container mt-3" >
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Search product name...">
                <button type="button" class="button"  id="searchButton">Search</button>
                <a href="cart.php" class="button">    
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    <span id="cart-icon"class="icon"></span>
                    </svg>
                </a>
            </div>
            <div class="row mt-3">
                <div class="col-md-6" style='padding-bottom:1vw;'>
                    <div class="category-box">
                        <label for="categorySelect" class="form-label">Select Category:</label>
                        <select class="form-select" id="categorySelect" onchange="filterProducts()">
                            <option value="">All</option>
                            <?php
                            $categoriesQuery = "SELECT * FROM categories";
                            $categoriesResult = mysqli_query($conn, $categoriesQuery);
                            if ($categoriesResult && mysqli_num_rows($categoriesResult) > 0) {
                                while ($category = mysqli_fetch_assoc($categoriesResult)) {
                                    echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['category_name']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    
<div class="scrollable-div " id="productDisplay">
    <!-- Products will be displayed here -->
 <?php
    function outputProductHTML($product) {
        
    }    
?>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="products_script.js"></script>

</body>
</html>
