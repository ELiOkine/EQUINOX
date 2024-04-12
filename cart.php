<?php
	include("settings/session.php");
	include("settings/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>EQUINOX</title>
	<link rel="icon" href="imgs/Equinox_logo.png" />
	<link rel = "stylesheet" type = "text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div id="header">
		<img src="imgs/Equinox_logo.png">
		<label>EQUINOX</label>
			
			<?php
				$id = (int) $_SESSION['id'];
			
					$query = mysqli_query ($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die (mysqli_connect_error());
					$fetch = mysqli_fetch_array ($query);
			?>
	
			<ul>
				<li><a href="function/logout.php"><i class="icon-off icon-white"></i>LOG OUT</a></li>
				<li>WELCOME:<a href="#profile"  data-toggle="modal"><i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname'];?></a></li>
			</ul>
	</div>
	
	<div id="profile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">My Account</h3>
				</div>
					<div class="modal-body">
						<?php
							$id = (int) $_SESSION['id'];
			
								$query = mysqli_query ($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die (mysqli_connect_error());
								$fetch = mysqli_fetch_array ($query);
						?>
						<center>
					<form method="post">
						<center>
							<table>
								<tr>
									<td class="profile">Name:</td><td class="profile"><?php echo $fetch['firstname'];?>&nbsp;<?php echo $fetch['lastname'];?></td>
								</tr>
								<tr>
									<td class="profile">Address:</td><td class="profile"><?php echo $fetch['address'];?></td>
								</tr>
								<tr>
									<td class="profile">Country:</td><td class="profile"><?php echo $fetch['country'];?></td>
								</tr>
								<tr>
									<td class="profile">ZIP Code:</td><td class="profile"><?php echo $fetch['zipcode'];?></td>
								</tr>
								<tr>
									<td class="profile">Mobile Number:</td><td class="profile"><?php echo $fetch['mobile'];?></td>
								</tr>
								
								<tr>
									<td class="profile">Email:</td><td class="profile"><?php echo $fetch['email'];?></td>
								</tr>
							</table>
						</center>
					</div>
				<div class="modal-footer">
					<a href="account.php?id=<?php echo $fetch['customerid']; ?>"><input type="button" class="btn btn-success" name="edit" value="Edit Account"></a>
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
					</form>
			</div>
	
	
	
	<br>
<div id="container">
	<div class="nav">	
			 <ul>
				<li><a href="home.php">   <i class="icon-home"></i>Home</a></li>
				<li><a href="cars.php">  <i class="icon-th-list"></i>Cars</a></li>
				<li><a href="aboutus1.php">  <i class="icon-bookmark"></i>About Us</a></li>
				<li><a href="contactus.php"><i class="icon-inbox"></i>Contact Us</a></li>
			
			</ul>
	</div>
	
	<form method="post" class="well" style="background-color:#fff;">
	<table class="table">
	<label style="font-size:25px;">My Cart</label>
		<tr>
			<th><h3>Image</h3></td>
			<th><h3>Car Name</h3></th>
			<th><h3>Seats</h3></th>
			<th><h3>Quantity</h3></th>
			<th><h3>Price</h3></th>
			<th><h3>Subtotal</h3></th>
		</tr>
	
<?php

	if (isset($_GET['id'])){
	    $id=$_GET['id'];
    }
	else
	    $id=1;
	if (isset($_GET['action']))
	    $action=$_GET['action'];
	else
	    $action="empty";


	switch($action)
	{
		
		case "view":
			if (isset($_SESSION['cart'][$id]))
			$_SESSION['cart'][$id];
		break;
		case "add":
            
			if (isset($_SESSION['cart'][$id]))
			    $_SESSION['cart'][$id]++;
			else
			    $_SESSION['cart'][$id]=1;

                
		break;
		case "remove":
			if (isset($_SESSION['cart'][$id]))
			{
				$_SESSION['cart'][$id]--;
				if ($_SESSION['cart'][$id]==0)
				unset($_SESSION['cart'][$id]);
			}
		break; 
		case "empty":
			unset($_SESSION['cart']);
		break;
	}

  
if (isset($_SESSION['cart']))
{	

	$total=0;

	foreach ($_SESSION['cart'] as $id => $x) {

        $result = mysqli_query ($conn, "SELECT * FROM car WHERE car_id = $id") or die(mysqli_connect_error());
    

        if (mysqli_num_rows($result) > 0) {
            $myrow = mysqli_fetch_array($result);
    
            $name = $myrow['car_name'];
            $name = substr($name, 0, 40);
            $price = $myrow['car_price'];
            $image = $myrow['car_image'];
            $car_size = $myrow['car_size'];
            $line_cost = $price * $x;
            $total = $total + $line_cost;   
    
            echo "<tr class='table'>";
            echo "<td><h4><img height='70px' width='70px' src='imgs/" . $image . "'></h4></td>";
            echo "<td><h4><input type='hidden' required value='" . $id . "' name='pid[]'> " . $name . "</h4></td>";
            echo "<td><h4>" . $car_size . "</h4></td>";
            echo "<td><h4><input type='hidden' required value='" . $x . "' name='quantity[]'> " . $x . "</h4></td>";
            echo "<td><h4>" . $price . "</h4></td>";
            echo "<td><strong><h3> $ " . $line_cost . "</h3></strong>";
            echo "</tr>";
        } else {
            echo "No rows found for Car ID: $id<br>";
        }
    }
    
		
		echo"<tr>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><h2>TOTAL COST:</h2></td>";
		echo "<td><strong><input type='hidden' value='".$total."' required name='total'><h2 class='text-danger'> $ ".$total."</h2></strong></td>";
		echo "<td></td>";
		echo "<td><a class='btn btn-danger btn-sm pull-right' href='cart.php?id=".$id."&action=empty'><i class='fa fa-trash-o'></i> Empty cart</a></td>";		
		echo "</tr>";
	}
 	else
		echo "<font color='#111' class='alert alert-error' style='float:right'> Your Cart is empty</font>";

?>
	</table>
	
	<div class='pull-right'>
	<a href='cars.php' class='btn btn-inverse btn-lg'>Continue Shopping ;)</a>
    <?php echo "<button name='pay_now' type='submit' class='btn btn-inverse btn-lg' >Buy</button>";
	include ("function/checkout_handler.php"); 
	?>
	</form>

	</div>

		
		</div>
			
			
		<br />		
		<br />	
</div>
</body>

<div id="footer" style="position: absolute; bottom: 0; width: 100%;">
    <div class="foot">
        <p style="font-size:25px;">Equinox incorporated</p>
    </div>
			
	
</html>