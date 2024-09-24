<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="button.css">


    <style>
        /* Custom CSS for logo size and navbar height */
        .navbar {
            background-color: #848484;
            margin: 0; /* Remove margin */
            padding: 0; /* Remove padding */
            width:100%;
        }
        .navbar-brand img {
            width: 8vw; /* Adjust logo size */
            height: 8vh; /* Adjust logo size */
            margin-right: 10px; /* Spacing between logo and links */
        }
        .navbar-nav .nav-link {
            margin-right: 20px; /* Spacing between links */
            color: black;
        }
        .navbar-nav .nav-link:hover {
            background-color: #DB4646;
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            border-radius: 0.5vh;
        }
        .top-bar {
            background-color: #848484;
            color: white;
            padding: 5px 15px; /* Adjusted padding */
            text-align: right;
            margin: 0; /* Remove margin */
            font-size: 20px;
        }
        .top-bar span {
            font-size: 1vw;
            color: white;
        }
        .top-bar a {
            text-decoration: none;
            color: white; /* Ensure link color matches the top bar color */
            margin-left: 10px;
        }
        .navbar-nav {
            margin: 0; /* Remove margin for responsive layout */
        }
        .divider {
            height: 1px;
            background-color: black;
            margin: 0; /* Remove margin */
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar{
               
               padding-left: 30px;
           }
            .navbar-brand img {
                width: 6vw; /* Adjust logo size for smaller screens */
                height: 8vh; /* Adjust logo size for smaller screens */
            }
            .navbar-nav {
                text-align: center; /* Center align links on smaller screens */
                width: 100%;
            }
            .navbar-nav .nav-link {
                margin: 10px 0; /* Stack links vertically on smaller screens */
                display: block;
            }
        }

        @media (max-width: 576px) {
            .navbar{
               
               padding-left: 60px;
           }
            .navbar-nav {
                text-align: center; /* Center align links on smaller screens */
                width: 100%;
            }
            .navbar-brand img {
                width: 20vw; /* Adjust logo size for smaller screens */
                height: 10vh; /* Adjust logo size for smaller screens */
            }
            .top-bar {
                font-size: 16px; /* Reduce font size for very small screens */
                padding:  10px; /* Adjust padding for very small screens */
            }
            .top-bar span {
                font-size: 2vw; /* Adjust font size for very small screens */
            }
        }
    </style>
</head>
<body>
    <!-- Top Bar with Email and Phone -->
    <div class="top-bar">
        <a href="mailto:osheintrading@gmail.com"><span>osheintrading@gmail.com</span></a>|
        <a href="tel:+940717192008"><span>+94 071 7192008</span></a>
    </div>
    
    <!-- Divider Line -->
    <div class="divider"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo (Image) -->
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo">
            </a>

            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products-section">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Your cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
