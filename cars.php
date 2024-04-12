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
	
	
	<script src="js/transition.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div id="header">
		<img src="imgs/Equinox_logo.png">
		<label>EQUINOX</label>
		
			<?php
				$id = (int) $_SESSION['id'];
			
					$query = mysqli_query ($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die (mysqli_connect_error($conn));
					$fetch = mysqli_fetch_array ($query);
			?>
	
			<ul>
				<li><a href="function/logout.php"><i class="icon-off icon-white"></i>LOG OUT</a></li>
				<li>WELCOME:<a href="#profile" href  data-toggle="modal"><i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname'];?></a></li>
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
			
								$query = mysqli_query ($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die (mysqli_connect_error($conn));
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
				<li><a href="home.php"><i  ></i>Home</a></li>
				<li><a href="cars.php"><i  ></i>Cars</a>
				<li><a href="aboutus1.php"><i ></i>About Us</a></li>
				<li><a href="contactus.php"><i ></i>Contact Us</a></li>
			</ul>
		</div>
		
		<div class="nav1">
			<ul>
				<li><a href="cars.php" class="active" style="color:#111;" >PORSCHE</a></li>
				<li>|</li>
				<li><a href="lamboghini.php" >LAMBOGHINI</a></li>
				<li>|</li>
				<li><a href="tesla.php">TESLA</a></li>
			</ul>

		</div>
	
	<div id="content">
		<br />
		<br />
		<div id="product">
			
        <?php 
				
				$query = mysqli_query($conn, "SELECT * FROM car WHERE brand = 'porsche' ORDER BY car_id DESC") or die(mysqli_connect_error($conn));

				while ($fetch = mysqli_fetch_array($query)) {
					$pid = $fetch['car_id'];
			
					$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE car_id = '$pid'") or die(mysqli_connect_error($conn));
					$rows = mysqli_fetch_array($query1);
			
					$qty = $rows['quantity'];
					if ($qty <= 1) {
						// Skip products with low stock
					} else {
						echo "<div class='float'>";
						echo "<center>";
						echo "<a href='details.php?id=" . $fetch['car_id'] . "'><img  src='imgs/" . $fetch['car_image'] . "' height='300px' width='600px'></a>";
						echo " " . $fetch['car_name'] . "";
						echo "<br />";
						echo "$" . $fetch['car_price'] . "";
						echo "</center>";
						echo "</div>";
					}
				}
				?>
		</div>
		
		
		

	
        </div>

<br>
</div>
<br>
<div id="footer" style="position: absolute; bottom: 0; width: 100%;">
    <div class="foot">
        <p style="font-size:25px;">EQUINOX INCORPORATED</p>
    </div>
</div>
</div>
</body>
</html>