<?php
include('connect.php');
?>

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href='admin_sidebar.css'>
</head>
<body>

<!-- The sidebar -->
<div class="sidebar">
<img src="logo.png" height="100vh"width="140vw" />
<button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
  <a  href="admin_dashborad.php">Manage Products</a>
  <a  href="admin_manage_orders.php">Manage Orders</a>
  <a  href="admin_banners.php">Manage banners</a>
  <a  href="admin_categories.php">Manage categories</a>
  <a  href="admin_contact_us.php">Manage FeedBack</a>  
  <a  href="admin_profile.php">Your Profile</a>
  <a  href="admin.php">Logout</a>
</div>
</div>
</body>
</html>