<?php
	include("settings/session.php");
	include("settings/connection.php");
	include("function/cash.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><Em>EQUINOX</Em></title>
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
				<li><a href="cars.php"> <i class="icon-th-list"></i>cars</a></li>
				<li><a href="aboutus1.php">   <i class="icon-bookmark"></i>About Us</a></li>
				<li><a href="contactus.php"><i class="icon-inbox"></i>Contact Us</a></li>
			</ul>
	</div>
		<?php 
			if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = mysqli_query($conn, "SELECT * FROM car WHERE car_id = '$id' ");
			$row = mysqli_fetch_array($query);
		?>
				<div>
					<center>
						<img class="img-polaroid" style="width:600px; height:350px;" src="imgs/<?php echo $row['car_image']; ?>">
						<h2 class="text-uppercase bg-primary"><?php echo $row['car_name']?></h2>
						<h3 class="text-uppercase">Seats : <?php echo $row['car_size']?></h3>
                        <h3 class="text-uppercase">Car type: <?php echo $row['car_type']?></h3>
                        <h3 class="text-uppercase">Average Distance: <?php echo $row['average_distance']?></h3>
                        <h3 class="text-uppercase">$ <?php echo $row['car_price']?></h3>
						<?php echo "<a href='cart.php?id=".$id."&action=add'><input type='submit' class='btn btn-inverse' name='add' value='Add to Cart'></a> &nbsp;  <a href='cars.php'><button class='btn btn-inverse'>Back</button></a> " ?>
					</center>
				</div>
		<?php }?>
		


</div>
		<br />	
</div>
	<br />
	<div id="footer">
		<div class="foot">
			<p style="font-size:25px;">EQUINOX INCORPORATED</p>
		</div>
			
			<div id="foot">
				<h4></h4>
					<ul>
					</ul>
			</div>
			
			<div id="develop">
				
				
			</div>
	</div>
</body>
</html>