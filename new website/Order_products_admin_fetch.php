<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['id'];
    $customer_name = $_POST['customer_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $oder_date=$_POST['order_date'];
    $status=$_POST['status'];
    $total_products=$_POST['total_products'];
    $sql="SELECT * FROM customer";
}
?>   
</body>
</html>