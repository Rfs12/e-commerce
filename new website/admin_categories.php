<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Banners</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href='admin_sidebar.css'>
    <link rel="stylesheet"href="button.css">
</head>
<body>
<?php
include('sidebar.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name=$_POST['category_name'];

    $sql="INSERT INTO categories(category_name)VALUES('$category_name')";
    $result=mysqli_query($conn,$sql);

    if(!$result){
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'error',
                                    text: 'error of Category Name',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
            
                                });
                            </script>";
    }
    else{
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'success',
                                    text: 'New Category Uploaded succsessfully',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
            
                                });
                            </script>";
    }
}
?>

<div class="container">

    <div class="container mt-5">
        <h1>Manage Categories</h1>
        <form action="admin_categories.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Category Name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required>
            </div>
            <button type="submit" class="button">Add New Category</button>
        </form>

        <h2 class="mt-5">Existing categories</h2>
        <table class="table table-striped table-hover"style="width: 30vw;">
    <thead >
        <tr>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?Php
    $result = mysqli_query($conn, "SELECT * FROM categories");

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
            echo "<td><a href='admin_delete_category.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }
    }else{
            echo"not found";
        }
    ?>
    </tbody>
</table>
</div>
</div>

</body>
</html>