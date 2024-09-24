<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="button.css">
</head>
<body>
<?php
include('connect.php'); // Ensure this file contains your database connection details

$id = "";
$name = "";
$model_number = "";
$price = "";
$quantity = "";
$description = "";
$category_id = "";
$existing_images = []; // Array to store existing image paths
$new_images = []; // Array to store new image paths
$errormessage = "";
$successmessage = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $model_number = $_POST['model_number'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    
    // Handle file uploads properly, this part needs adjustment based on your file upload strategy
    if (!empty($_FILES['img']['name'][0])) {
        $imagePaths = [];
        foreach ($_FILES['img']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['img']['name'][$key]);
            $targetFilePath = "uploads/" . $fileName;

            // Move the uploaded file to the server
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $imagePaths[] = $targetFilePath;
            } else {
                $errormessage = "Failed to move uploaded file.";
                break;
            }
        }
        // Convert the array of image paths to a JSON string
        $new_images = json_encode($imagePaths);
    }

    // Update product in the database
    $sql = "UPDATE products SET name='$name', model_number='$model_number', price='$price', quantity='$quantity', description='$description', category_id='$category_id'";
    
    // Check if new images are uploaded
    if (!empty($new_images)) {
        $sql .= ", img='$new_images'";
    }
    $sql .= " WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        // Product updated successfully
        // Redirect with success message or handle success case
        header("Location: edit_product.php?id=$id&success=Product updated successfully");
        exit;
    } else {
        // Error updating product
        $errormessage = "Error updating product: " . mysqli_error($conn);
        // Set error message and handle error case
        // For example, you can use a session variable or redirect with error flag
        header("Location: edit_product.php?id=$id&error=" . urlencode($errormessage));
        exit;
    }
}

// Fetch existing product details if editing
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $name = $row['name'];
        $model_number = $row['model_number'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $description = $row['description'];
        $category_id = $row['category_id'];
        
        // Handle existing images
        $existing_images = json_decode($row['img'], true);
    } else {
        header("location: admin_dashborad.php"); // Redirect if product not found
        exit;
    }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container mt-5">
        <h1>Edit Product</h1>
        
        <form enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="modelNumber" class="form-label">Model Number</label>
                <input type="text" class="form-control" id="modelNumber" name="model_number" value="<?php echo $model_number; ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>
            </div>
            <!-- Adjust file input handling if multiple images are allowed -->
            <div class="mb-3">
                <label for="img" class="form-label">New Images</label>
                <input type="file" class="w-100"  name="img[]" multiple>
            </div>
            <?php if (!empty($existing_images)): ?>
                <div class="mb-3">
                    <label>Images Already Uploaded:</label><br>
                    <?php foreach ($existing_images as $imagePath): ?>
                        <img src="<?php echo $imagePath; ?>" alt="Product Image" style="max-width: 200px; margin-bottom: 10px;">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category_id" required>
                    <option value="" selected disabled>Select Category</option>
                    <?php
                    // Fetch categories from the database
                    $categoriesQuery = "SELECT * FROM categories";
                    $categoriesResult = mysqli_query($conn, $categoriesQuery);
                    
                    if ($categoriesResult && mysqli_num_rows($categoriesResult) > 0) {
                        while ($category = mysqli_fetch_assoc($categoriesResult)) {
                            $selected = ($category_id == $category['id']) ? "selected" : "";
                            echo "<option value='" . htmlspecialchars($category['id']) . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <!-- Display existing images -->            
            <button type="submit" class="button">Update Product</button>
        </form>
    </div>
<!-- SweetAlert JavaScript -->
<script>
    // Function to show SweetAlert success message
    function showSuccessMessage(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            timer: 2000, // Optional timer for auto close
            showConfirmButton: false
        }).then(function() {
            // Optional: Redirect to another page after success
            window.location.href = 'admin_dashborad.php';
        });
    }

    // Function to show SweetAlert error message
    function showErrorMessage(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }

    // Check URL parameters for success or error messages
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');
    const errorMessage = urlParams.get('error');

    // Display success message if exists
    if (successMessage) {
        showSuccessMessage(successMessage);
    }

    // Display error message if exists
    if (errorMessage) {
        showErrorMessage(errorMessage);
    }
</script>


</body>
</html>
