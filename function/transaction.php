<?php

include("settings/session.php");
include("settings/connection.php");

if (isset($_POST['add']))
{
	
	
	$customer = $_POST['customer'];
	$car = $_POST['car_name'];
	$price = $_POST['car_price'];
	$qty = $_POST['quantity'];
	$amount = $_POST['amout'];

    
	
	mysqli_query($conn, "INSERT INTO cart (car_id,cust_id)  VALUES ('$car_id', '$cust_id')  ") or die(mysqli_connect_error());
								
	header("location: cars.php");	
}
?>