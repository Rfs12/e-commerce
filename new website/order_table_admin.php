<?php
include('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        th {
            position: sticky;
            top: 0;
            z-index: 100;
        }
    </style>
    <!-- Bootstrap CSS -->
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Manage Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href='admin_sidebar.css'>
    <style>
@media (max-width: 577px)  {
  body{
    overflow-x: hidden;
  }
  .button, .form-control,.icon {
    font-size: 10px; /* Slightly larger font size */
    height: 11vw; /* Adjusted height for larger screens */
    font-size: 1em; /* Icon size relative to button text */
    padding-top:0.3em;

  }
  .table{
    margin-top:7vw;
  }
  
}
@media screen and (max-width: 700px) {
    .sidebar {
        width: 700px;
       /* Allow content to dictate height */
        position: relative; /* Adjust position for smaller screens */
    }
}

/* For medium to large devices (tablets and desktops) */
@media (min-width: 769px) and (max-width: 1024px) {
  body{
    overflow-x: hidden;
  }
  .button, .form-control,.icon {
  font-size: 10px; /* Slightly larger font size */
    height: 7vw; /* Adjusted height for larger screens */
    font-size: 1.1em; /* Icon size relative to button text */
    padding-top:0.3em;
  }
 
  }


/* For extra large devices (large desktops and monitors) */
@media (min-width: 1025px) {
 
  .button {
    height: 4vw; /* Adjusted height for large screens */
    font-size: 1.1em; /* Icon size relative to button text */
    padding-top:0.4em;
  }
  
}
    </style>
</head>
<body>
<table class="table table-striped table-hover" >
    <thead>
        <tr>
            <th style="background-color:black;color:white;">Order ID</th>
            <th style="background-color:black;color:white;">Customer Name</th>
            <th style="background-color:black;color:white;">Phone Number</th>
            <th style="background-color:black;color:white;">Email</th>
            <th style="background-color:black;color:white;">Order Date</th>
            <th style="background-color:black;color:white;">Order Status</th>
            <th style="background-color:black;color:white;">Order Details</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Allorders = "SELECT * FROM customer"; // Assuming 'customers' table holds customer details
        $result = mysqli_query($conn, $Allorders);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($customer = mysqli_fetch_assoc($result)) {
                $statusColor = $customer['status'] == 'delivered' ? 'green' : 'red';
                echo "<tr>";
                echo "<td>" . htmlspecialchars($customer['id']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['customer_name']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['phone_number']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['email']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['order_date']) . "</td>";
                echo "<td style='color:$statusColor;'>" . htmlspecialchars($customer['status']) . "</td>";
                echo "<td><button class='button' onclick=\"window.location.href='order_details_admin.php?id=" . urlencode($customer['id']) . "'\">View Orders</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No customers found.</td></tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
