<?php
	include("../settings/connection.php");
		
		
		$t_id = $_GET['id'];
		
		mysqli_query($conn, "UPDATE transaction SET order_stat = 'Order Cancelled' WHERE transaction_id = '$t_id'") or die(mysqli_connect_error());
								
		header("location: transaction.php");	
		
		?>