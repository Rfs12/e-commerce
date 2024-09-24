<?php
	
	$servername="localhost";
	$user_name="root";
	$password= "";
	$dbname="osheinn";
	
	$conn=new mysqli($servername,$user_name,$password,$dbname);
	
	if($conn)
	{
	}
	else 
	{
		echo "connection failed".mysqli_connect_error();
	}
	
	