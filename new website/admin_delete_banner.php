<?php
include('connect.php');

if (isset($_GET['id'])) {
    $banner_id = $_GET['id'];

    // Fetch the banner details to delete the image file from the server
    $query = "SELECT image_path FROM banners WHERE id = '$banner_id'";
    $result = mysqli_query($conn, $query);
    $banner = mysqli_fetch_assoc($result);

    if ($banner) {
        // Delete the image file from the server
        if (file_exists($banner['image_path'])) {
            unlink($banner['image_path']);
        }

        // Delete the banner from the database
        $delete_query = "DELETE FROM banners WHERE id = '$banner_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>
                    alert('Banner deleted successfully');
                    window.location.href = 'admin_banners.php';
                  </script>";
        } else {
            echo "Error deleting banner: " . mysqli_error($conn);
        }
    } else {
        echo "Banner not found.";
    }
} else {
    echo "Invalid request.";
}
