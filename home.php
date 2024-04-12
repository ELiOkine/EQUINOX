<?php
include("settings/session.php");
include("settings/connection.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>EQUINOX</title>
	<link rel="icon" href="imgs/Equinox_logo.png" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="header">
		<img src="imgs/Equinox_logo.png">
		<label>EQUINOX</label>

		<?php
		$id = (int) $_SESSION['id'];

		$query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die(mysqli_connect_error($conn));
		$fetch = mysqli_fetch_array($query);
		?>

		<ul>
			<li><a href="function/logout.php"><i class="icon-off icon-white"></i>LOG OUT</a></li>
			<li>WELCOME:<a href="#profile" href data-toggle="modal"><i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname']; ?></a></li>
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

			$query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die(mysqli_connect_error($conn));
			$fetch = mysqli_fetch_array($query);
			?>
			<center>
				<form method="post">
					<center>
						<table>
							<tr>
								<td class="profile">Name:</td>
								<td class="profile"><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname']; ?></td>
							</tr>
							<tr>
								<td class="profile">Address:</td>
								<td class="profile"><?php echo $fetch['address']; ?></td>
							</tr>
							<tr>
								<td class="profile">Country:</td>
								<td class="profile"><?php echo $fetch['country']; ?></td>
							</tr>
							<tr>
								<td class="profile">ZIP Code:</td>
								<td class="profile"><?php echo $fetch['zipcode']; ?></td>
							</tr>
							<tr>
								<td class="profile">Mobile Number:</td>
								<td class="profile"><?php echo $fetch['mobile']; ?></td>
							</tr>
							<tr>
								<td class="profile">Email:</td>
								<td class="profile"><?php echo $fetch['email']; ?></td>
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




		<div id="content">
			<div class="nav">

				<ul>
					<li><a href="home.php"><i class="icon-home" class="active"></i>Home</a></li>
					<li><a href="cars.php"><i class="icon-th-list"></i>Cars</a></li>
					<li><a href="aboutus1.php"><i class="icon-bookmark"></i>About Us</a></li>
					<li><a href="contactus.php"><i class="icon-inbox"></i>Contact Us</a></li>
					
				</ul>
			</div>

			<div id="carousel">
				<div id="myCarousel" class="carousel slide">
					<div class="carousel-inner">
						<div class="item" style="padding:0; border-bottom:0 solid #111;"><img src="imgs/BANNER5.jpg" class="carousel"></div>
						<div class="active item" style="padding:0; border-bottom:0 solid #111;"><img src="imgs/BANNER4.jpg" class="carousel"></div>
						<div class="item" style="padding:0; border-bottom:0 solid #111;"><img src="imgs/Banner3.jpg" class="carousel"></div>
					</div>
					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
			</div>


			<div id="video">
				<video controls autoplay muted width="445px" height="300px">
					<source src="css/vid/AD3.mp4" type="video/mp4">
				</video>
			</div>


			<div id="content">
				<div id="product" style="position:relative; margin-top:30%; ">
					<center>
						<h2>
							<legend> PORSCHE</legend>
						</h2>
					</center>

					<br />

					<?php

					$query = mysqli_query($conn, "SELECT * FROM car WHERE brand = 'Porsche' ORDER BY car_id DESC") or die(mysqli_connect_error($conn));

					while ($fetch = mysqli_fetch_array($query)) {
						$pid = $fetch['car_id'];

						$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE car_id = '$pid'") or die(mysqli_connect_error($conn));
						$rows = mysqli_fetch_array($query1);

						$qty = $rows['quantity'];
						if ($qty <= 5) {
						} else {
							echo "<div class='float'>";
							echo "<center>";
							echo "<a href='cars.php?id=" . $fetch['car_id'] . "'><img  src='imgs/" . $fetch['car_image'] . "' height='50px' width='50px'></a>";

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

		</div>


	</div>

	<br>
	</div>
	<br>
	<div id="footer" style="width: 100%;">
		<div class="foot">
			<p style="font-size:25px;">EQUINOX INCORPORATED</p>
		</div>
	</div>
</body>

</html>