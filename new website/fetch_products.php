 <!-- Products will be displayed here -->
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
</head>
<body>
 <?php
 include('connect.php');
 function outputProductHTML($product) {
    // Decode the JSON string back into an array
    $images = json_decode($product['img'], true);

    echo "<div class='card' data-id='" . $product['id'] . "'>";
    
    // Display only the first image
    echo "<div >";
    echo "<img src='" . htmlspecialchars($images[0]) . "' alt='" . htmlspecialchars($product['name']) . "' class='card-img-top image' >";
    echo "</div>";

    echo '<div class="card-body">';
    echo "<h5 class='card-title'>" . htmlspecialchars($product['name']) . "</h5>";
    echo "<h6 class='card-title'>Model Number:" . htmlspecialchars($product['model_number']) . "</h5>";
    echo "<h5 class='card-title'>Rs." . htmlspecialchars($product['price']) . ".00</h5>";
    echo "<input type='number' min='1' class='form-control quantity' data-id='" . $product['id'] . "' value='1' style='margin-bottom:10px;'>";
    echo "<button type='button'  class='button add-to-cart' data-id='" . $product['id'] . "' data-name='" . htmlspecialchars($product['name']) . "' data-price='" . htmlspecialchars($product['price']) . "' data-img='" . htmlspecialchars($images[0]) . "'>Add to Cart</button>";
    echo "</div>";
    echo "</div>";
}

    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $query = "SELECT p.* FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE 1=1";

    if ($category != '') {
        $query .= " AND p.category_id = '$category'";
    }
    if ($search != '') {
        $query .= " AND (p.name LIKE '%$search%' OR p.model_number LIKE '%$search%')";
    }
    $res = mysqli_query($conn, $query);

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            while ($product = mysqli_fetch_assoc($res)) {
                outputProductHTML($product);
            }
        } else {
            echo "<div class='alert alert-danger custom-alert d-flex align-items-center justify-content-center'>
                    There are no products matching your search.
                  </div>";
        }
    }
    ?>

<script>
function updateCartCount() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("cart-icon").innerHTML = "Cart (" + xhr.responseText + ")";
            } else {
                console.error("Error fetching cart count: " + xhr.status);
            }
        }
    };
    xhr.open("GET", "carticon.php", true);
    xhr.send();
}

updateCartCount();

document.addEventListener('DOMContentLoaded', function() {
    bindCardEvents();
    bindAddToCartButtons();
});

function bindCardEvents() {
    var cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
        card.addEventListener('click', function(event) {
            if (event.target.classList.contains('quantity') || event.target.classList.contains('add-to-cart')) {
                return;
            }
            var productId = card.getAttribute('data-id');
            window.location.href = 'productsdesc.php?id=' + productId;
        });
    });
}

function bindAddToCartButtons() {
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            var productId = this.getAttribute('data-id');
            var productName = this.getAttribute('data-name');
            var productPrice = this.getAttribute('data-price');
            var productImg = this.getAttribute('data-img');
            var quantityInput = document.querySelector('.quantity[data-id="' + productId + '"]');
            var productQuantity = quantityInput ? quantityInput.value : 1;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        updateCartCount();
                    } else {
                        alert('Error: ' + xhr.status);
                    }
                }
            };
            xhr.open('POST', 'product_add.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var params = 'action=add' +
                         '&id=' + encodeURIComponent(productId) +
                         '&name=' + encodeURIComponent(productName) +
                         '&price=' + encodeURIComponent(productPrice) +
                         '&img=' + encodeURIComponent(productImg) +
                         '&quantity=' + encodeURIComponent(productQuantity);
            xhr.send(params);
        });
    });
}

function filterProducts() {
    var category = document.getElementById('categorySelect').value;
    var search = document.getElementById('searchInput').value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.querySelector('.scrollable-div').innerHTML = xhr.responseText;
                bindCardEvents();
                bindAddToCartButtons();
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.open('GET', 'fetch_products.php?category=' + category + '&search=' + search, true);
    xhr.send();
}

document.getElementById('searchButton').addEventListener('click', filterProducts);
</script>
</body>
</html>