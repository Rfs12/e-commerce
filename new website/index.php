<?php
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="main.css" type="text/css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
    <link href="button.css" type="text/css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <title>Oshein trading pvt ltd</title>
    <style>
     
      /* Custom CSS for icon size */
      .feature-icon {
        font-size: 3rem;
      }
      .feature-box {
        /* Light gray background color */
        padding: 20px; /* Padding around each feature */
        margin-bottom: 100px; /* Margin between each feature */
        border-radius: 10px; /* Rounded corners */
        background-color:#E3E3E3;
        width: 100%;
      }
      .carousel-item img {
        height: 30vw;
      }
  
      .carousel-indicators li {
        background-color: #343a40; /* Dark color for indicators */
      }
      .carousel-control-prev-icon, .carousel-control-next-icon {
        background-color: black; /* Dark color for controls */
      }
      .footer {
            background-color: #848484;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 3vw;

        }
        .footer a {
            color: white;
            margin: 0 1vw;
        }
    </style>
  </head>
  <body>
 
    <!-- Include Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('usersidebar.php');?>
<!-- Carousel -->
<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM banners");
    $count = mysqli_num_rows($result);
    for ($i = 0; $i < $count; $i++) {
        echo '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="' . ($i == 0 ? 'active' : '') . '"></li>';
    }
    ?>
    </ol>
    <div class="carousel-inner">
    <?php
    $first = true;
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">';
        echo '<img src="' . $row['image_path'] . '" class="d-block w-100" alt="' . htmlspecialchars($row['title']) . '">';
        if (!empty($row['title']) ) {
            echo '<div class="carousel-caption d-none d-md-block">';
            if (!empty($row['title'])) {
                echo '<h5 style="color:black;">' . htmlspecialchars($row['title']) . '</h5>';
            }
           
            echo '</div>';
        }
        echo '</div>';
        $first = false;
    }
    ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
    <!--about company-->
   
<!--        DISPLAY 3 ITENS        -->
<div class="slider-rotate" id="slider-2">

  <div class="slider-rotate__container">

    <!-- ITENS -->
    <div class="slider-rotate__item "><span class="position"></span><img src="vecteezy_nissan-logo-vector-nissan-icon-free-vector_20190692.jpg"></div>
    <div class="slider-rotate__item"><span class="position"></span><img src="vecteezy_toyota-brand-logo-car-symbol-with-name-black-design-japan_20927378.jpg"></div>
    <div class="slider-rotate__item"><span class="position"></span><img src="vecteezy_honda-logo-brand-symbol-black-with-name-red-design-japan-car_20498756.jpg"></div>
    <div class="slider-rotate__item"><span class="position"></span><img src="vecteezy_lexus-brand-logo-car-symbol-with-name-black-design-japan_20500685.jpg"></div>
 
    <!-- NAVIGATION -->
    <span class="slider-rotate__arrow slider-rotate__arrow--right js-slider-rotate-arrow" data-action="next"><i class="fa fa-angle-right fa-3x"></i></span>
    <span class="slider-rotate__arrow slider-rotate__arrow--left js-slider-rotate-arrow" data-action="prev"><i class="fa fa-angle-left fa-3x"></i></span>

  </div>

</div>

<div class="container">
  <div class="row text-center">
    <div class="col-md-3">
    <div class="feature-box">
      <img src="https://cdn-icons-png.flaticon.com/128/2769/2769339.png" class="fas fa-shipping-fast feature-icon"></i>
      <p>Shipping</p>
      <p>For all orders</p>
    </div>
    </div>
    <div class="col-md-3">
    <div class="feature-box">
      <img src="https://cdn-icons-png.flaticon.com/128/950/950299.png" class="fas fa-headset feature-icon"></i>
      <p>Support 24/7</p>
      <p>Always feedback customer 24/7</p>
    </div>
    </div>
    <div class="col-md-3">
    <div class="feature-box">
      <img src="https://cdn-icons-png.flaticon.com/128/5500/5500861.png" class="fas fa-money-bill-wave feature-icon"></i>
      <p>100% Money Back</p>
      <p>14 days for return</p>
    </div>
    </div>
    <div class="col-md-3">
    <div class="feature-box">
      <img src="https://cdn-icons-png.flaticon.com/128/5711/5711557.png" class="fas fa-lock feature-icon"></i>
      <p>Safe Payment</p>
      <p>Safe shopping guarantee</p>
    </div>
  </div>
  </div>
</div>
  
<!-- Font Awesome -->

    <!--managers-->
    <div class="container_marketing" style="text-align:center;">
      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
            <image x="0" y="0" width="140" height="140" href="IMG_0770.jpg" preserveAspectRatio="xMidYMid slice"/>
          </svg>
          <h2>Heading</h2>
          <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
            <image x="0" y="0" width="140" height="140" href="IMG_0770.jpg" preserveAspectRatio="xMidYMid slice"/>
          </svg>
  
          <h2>Heading</h2>
          <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
            <image x="0" y="0" width="140" height="140" href="IMG_0770.jpg" preserveAspectRatio="xMidYMid slice"/>
          </svg>
  
          <h2>Heading</h2>
          <p>And lastly this, the third column of representative placeholder content.</p>
        </div><!-- /.col-lg-4 -->
      </div>
      </div>


<!--search option with show products--> 

  <?php include('products.php');?>
<!--footor-->
<footer class="footer">
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="facebook" viewBox="0 0 16 16">
    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
  </symbol>
  <symbol id="instagram" viewBox="0 0 16 16">
      <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
  </symbol>
  <symbol id="twitter" viewBox="0 0 16 16">
    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
  </symbol>
</svg>
<div class="b-example-divider"></div>
<div class="container ">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top footer">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary"style="font-size:20px;">&copy; 2024 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
    </ul>
  </footer>   
  <!-- Include Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
<!--image slider-->
<script src="brandrotateindex.js"></script>
  </body>
</html>
