<?php
		include("../settings/connection.php");

		
		$t_id = $_GET['id'];
		
		mysqli_query($conn, "UPDATE transaction SET order_stat = 'Confirmed' WHERE transaction_id = '$t_id'") or die(mysqli_connect_error());
						
		
		$query2 = mysqli_query($conn, "SELECT * FROM transaction_detail LEFT JOIN car ON car.car_id = transaction_detail.car_id WHERE transaction_detail.transaction_id = '$t_id'") or die (mysqli_connect_error());
		while($row = mysqli_fetch_array($query2)){
		
		$pid = $row['car_id'];
		$oqty = $row['order_qty'];
		
		$query3 = mysqli_query($conn, "SELECT * FROM stock WHERE car_id = '$pid'") or die (mysqli_connect_error());
		$row3 = mysqli_fetch_array($query3);
		
		$stck = $row3['quantity']; 
		
		$stck_out = $stck - $oqty;
		
		$query = mysqli_query($conn, "UPDATE stock SET quantity = '$stck_out' WHERE car_id = '$pid'") or die(mysqli_connect_error());
		}
		header("location: transaction.php");	
		
		?>