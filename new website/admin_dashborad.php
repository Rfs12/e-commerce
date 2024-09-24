<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href='admin_sidebar.css'>
    <link rel="stylesheet" href='button.css'>
</head>
<body>
<?php
include('connect.php');
?>
<!-- The sidebar -->
<?php include('sidebar.php');?>

<!-- Page content -->
<div class="content">

    <!-- Page Content -->
    <div id="main-content">
        <!-- Navbar -->
    
        <!-- Content -->
        <div class="container-fluid container">
            <div class="row">
                <!-- Add Product Form -->
                <div class="col-md-4">
                    <h1>Add Product</h1>
                    <form id="addProductForm" class="form input" enctype="multipart/form-data" method="POST">
                        <!-- Form fields -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="name"  required>
            </div>
            <div class="mb-3">
        <label for="modelNumber" class="form-label">Model Number</label>
        <input type="text" class="form-control" id="modelNumber" name="model_number"  required>
    </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price"  required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"  required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" name="img[]" multiple required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description"  name="description"  rows="3"  required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category"  name="category_id" required>
                    <option value="" selected disabled>Select Category</option>
                    <?php
                    // Fetch categories from the database
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
           
            <button type="submit" class="button">Add Product</button>
                    </form>
                </div>
                <!-- Product List -->
                <div class="col-md-11" style="margin-top:5vw;">
                <div class="scrollable-div">
                    <?php include('product_list.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

       
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>


   
    <script>
    document.getElementById('addProductForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('add_product.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire('Success', data.message, 'success');
                 $('#productList').load('product_list.php');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error', 'There was an error processing your request.', 'error');
        });
    });
</script>
</body>
</html>
