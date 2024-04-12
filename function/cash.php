
<?php

	include('settings/connection.php');

	if (isset($_POST['cash']))
{
	$customer = $_POST['customer'];
	$car = $_POST['car_name'];
	$total = $_POST['car_price'];
	$destination = $_POST['destination'];
	
	
		mysqli_query($conn, "INSERT INTO `transaction` (customer, car, size, amount, payment) VALUES ('$customer', '$car', $total, '$destination', 'COD')")
		or die (mysqli_connect_error());				
}
?>