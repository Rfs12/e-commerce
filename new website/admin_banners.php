<?php
include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Banners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link href="button.css"  rel="stylesheet">
    <link rel="stylesheet" href='admin_sidebar.css'>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['banner_images'])) {
        $titles = $_POST['titles'];
        $banner_images = $_FILES['banner_images'];

        for ($i = 0; $i < count($banner_images['name']); $i++) {
            $target_dir = "uploads/";
            $file_name = basename($banner_images["name"][$i]);
            $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file = $target_dir . uniqid() . '.' . $imageFileType;
            $uploadOk = 1;

            // Check if image file is a actual image or fake image
            $check = getimagesize($banner_images["tmp_name"][$i]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($banner_images["size"][$i] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($banner_images["tmp_name"][$i], $target_file)) {
                    // Insert banner details into the database
                    $title = $titles[$i];
                    $image_path = $target_file;

                    $insert_query = "INSERT INTO banners (image_path, title) VALUES ('$image_path', '$title')";
                    if (mysqli_query($conn, $insert_query)) {
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'banner placed successfully',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
            
                                });
                            </script>";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
}
?>

<?php include('sidebar.php');?>

<!-- Page content -->
<div class="content">

    <!-- Page Content -->
    <div id="main-content">
        <!-- Navbar -->
    
        <!-- Content -->
        <div class="container-fluid container">
        <h1>Manage Banners</h1>
        <form action="admin_banners.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="banner_images" class="form-label">Select images to upload:</label>
                <input type="file" name="banner_images[]" id="banner_images" class="form-control" multiple required>
            </div>
            <div class="mb-3">
                <label for="titles" class="form-label">Titles:</label>
                <input type="text" name="titles[]" id="titles" class="form-control" >
            </div>
            <button type="submit" class="button">Upload Banners</button>
        </form>

        <h2 class="mt-5">Existing Banners</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM banners");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><img src='" . $row['image_path'] . "' width='100'></td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td><a href='admin_delete_banner.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>
