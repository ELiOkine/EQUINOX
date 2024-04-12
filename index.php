<?php 
	include("function/login.php");
	include("function/customer_signup.php");

?>
<!DOCTYPE html>
<body >

<html>
<head>

	<title>EQUINOX DEALERSHIP</title>
	<link rel="icon" href="../imgs/Equinox_logo.png">
	<link rel ="stylesheet" type = "text/css" href="css/style.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/button.css">
	
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/button.js"></script>
	<script src="js/dropdown.js"></script>
	<script src="js/tab.js"></script>
	<script src="js/transition.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="header">
		<img src="imgs/Equinox_logo.png">  
		<label style="color: white;">EQUINOX  CAR DEALERHSIP </label>       
			<ul>
				<li><a href="#signup"   data-toggle="modal">SIGN UP</a></li>
				<li><a href="#login"    data-toggle="modal">LOG IN</a></li>
			</ul>
	</div>
		<div  id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
			<div class="modal-header">
				<button type="button"  data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">LOG IN.</h3>
				
				
			</div>
				<div class="modal-body">
					<form method="post">
					<center>
						<input type="email" name="email" placeholder="Email" style="width:250px;">
						<input type="password" name="password" placeholder="Password" style="width:250px;">
					</center>
				</div>
			<div class="modal-footer">
				<input class="btn btn-primary" type="submit" name="login" value="Login">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
					</form>
			</div>
		</div>
	
		<div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
					<h3 id="myModalLabel" >Sign Up Here...</h3>
				</div>
					<div class="modal-body">
						<center>
					<form method="post">
						<input type="text" name="firstname" placeholder="Firstname" required>
						<input type="text" name="lastname" placeholder="Lastname" required>
						<input type="text" name="address" placeholder="Address" style="width:430px;"required>
						<input type="text" name="country" placeholder="Province" required>
						<input type="text" name="zipcode" placeholder="ZIP Code" required maxlength="4">
						<input type="text" name="mobile" placeholder="Mobile Number" maxlength="11">
						<input type="email" name="email" placeholder="Email" required>
						<input type="password" name="password" placeholder="Password" required>
						</center>
					</div>
				<div class="modal-footer">
					<input type="submit" class= "btn btn-primary"  name="signup" value="Sign Up">
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
					</form>
			</div>
	<br>
<div id="container">
	<div class="nav">
	
			 <ul>
				<li><a href="index.php"><i class="icon-home" class="active" ></i >Home</a></li>
				<li><a href="aboutus.php"><i class="icon-bookmark"></i>About Us</a></li>
			
			</ul>
	</div>
	
	<div id="carousel">
		<div id="myCarousel" class="carousel slide">
			<div class="carousel-inner">
				<div class=" item" style="padding:0; border-bottom:0 solid #111;"><img src="imgs/BANNER4.jpg" class="carousel"></div>
				<div class="active item" style="padding:0; border-bottom:0 solid #111;"><img src="imgs/BANNER5.jpg" class="carousel"></div>
				<div class="item" style="padding:0; border-bottom:0 solid #111;"><img src="imgs/BANNER6.jpg" class="carousel"></div>
		</div>
				<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
	</div>
	

	<div id="video">
	<video controls autoplay muted width="445px" height="300px">
    <source src="css/vid/AD2.mp4" type="video/mp4">
</video>
	</div>

	
	<div id="content">
		<div id="product" style="position:relative; margin-top:30%; ">
			<center><h2><legend>GET THE BEST CARS AT THE BEST AT THE BEST PRICES!!!</legend></h2></center>
			<br />
			
			<?php 
				
				$query = mysqli_query($conn, "SELECT * FROM car WHERE brand = 'Porsche' ORDER BY car_id DESC") or die(mysqli_connect_error($conn));

				while ($fetch = mysqli_fetch_array($query)) {
					$pid = $fetch['car_id'];
			
					$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE car_id = '$pid'") or die(mysqli_connect_error($conn));
					$rows = mysqli_fetch_array($query1);
			
					$qty = $rows['quantity'];
					if ($qty <= 1) {
					
					} else {
						echo "<div class='float'>";
						echo "<center>";
					echo "<a> <img src='imgs/" . $fetch['car_image'] . "' height='200px' width='800px' onclick='showLoginMessage()'></a>";

			
						echo " " . $fetch['car_name'] . "";
						echo "<br />";
						echo "$" . $fetch['car_price'] . "";
						echo "</center>";
						echo "</div>";
					}
				}
				?>
		</div>
	
   
    <script>
        function showLoginMessage() {

            document.getElementById("loginMessage").style.display = "block";
        }
    </script>

<div id="loginMessage" style="display: none;" class="btn" >
    <p>Please login to purchase.</p>
</div>



	
	
	</div>

	<br>
</div>
	<br>
	<div id="footer">
		<div class="foot">
			<p style="font-size:25px;">Equinox incorporated</p>
		</div>
	</div>
</body>
</html>