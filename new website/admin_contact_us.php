<?php include('connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="button.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
     .footer {
            background-color: #848484;
            color: white;
            padding: 20px 0px;
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
<?php
include('sidebar.php');
?>

<div class="container">

    <div class="container mt-5">
    <table class="table table-striped table-hover" >
    <thead>
        <tr>
            <th style="background-color:black;color:white;">Feedback ID</th>
            <th style="background-color:black;color:white;">Customer Name</th>
            <th style="background-color:black;color:white;">Email</th>
            <th style="background-color:black;color:white;">Subject</th>
            <th style="background-color:black;color:white;">Message</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql='SELECT * FROM contact';
        $result=mysqli_query($conn,$sql);
        if($result && mysqli_num_rows($result) > 0){
            while ($customer = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($customer['id']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['name']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['email']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['subject']) . "</td>";
                echo "<td>" . htmlspecialchars($customer['message']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No customers found.</td></tr>";
        }
        ?>
        </tbody>
        </table>
    </div>
    </div>

</body>
</html>
