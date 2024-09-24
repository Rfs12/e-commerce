<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
</head>
<body>
    <div class="container mt-5"id="productList">
    <table class="table table-striped table-hover table"  >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Model Number</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        <?php
include('connect.php');

$AllProducts = "SELECT * FROM products";
$resultofthis = mysqli_query($conn, $AllProducts);

if ($resultofthis && mysqli_num_rows($resultofthis) > 0) {
    while ($products = mysqli_fetch_assoc($resultofthis)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($products['name']) . "</td>";
        echo "<td>" . htmlspecialchars($products['price']) . "</td>";
        echo "<td>" . htmlspecialchars($products['model_number']) . "</td>";
        echo "<td><a href='edit_product.php?id=" . $products['id'] . "' class='btn btn-primary'><i style='font-size:17px' class='fa'>&#xf044;</i></a>";
        echo "<a href='delete_product_admin.php?id=" . $products['id'] . "' style='margin-left:1vw;' class='btn btn-danger'><i style='font-size:17px'class='material-icons'>&#xe872;</i></a></td>";
    }
} else {
    echo "<tr><td colspan='5'>No products found.</td></tr>";
}
?>

        </tbody>
    </table>
</div>
</body>
</html>
  