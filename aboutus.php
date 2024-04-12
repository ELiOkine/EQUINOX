<?php 
	include("function/login.php");
	include("function/customer_signup.php");

?>
<!DOCTYPE html>
<body >

<html>
<head>

	<title>EQUINOX</title>
	<link rel="icon" href="../imgs/Equinox_logo.png">
	<link rel ="stylesheet" type = "text/css" href="css/style.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="header">
		<img src="imgs/Equinox_logo.png">
		<label style="color: white;">EQUINOX</label>
			<ul>
				<li><a href="#signup"   data-toggle="modal">SIGN UP</a></li>
				<li><a href="#login"   data-toggle="modal">LOG IN</a></li>
			</ul>
	</div>
		<div  id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Login.</h3>
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
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Sign Up Here...</h3>
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
					<input type="submit" class="btn btn-primary" name="signup" value="Sign Up">
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
	




<link rel="stylesheet" type="text/css" href="css/aboutus.css">
<div class="container noselect">
  <div class="canvas">
    <div class="tracker tr-1"></div>
    <div class="tracker tr-2"></div>
    <div class="tracker tr-3"></div>
    <div class="tracker tr-4"></div>
    <div class="tracker tr-5"></div>
    <div class="tracker tr-6"></div>
    <div class="tracker tr-7"></div>
    <div class="tracker tr-8"></div>
    <div class="tracker tr-9"></div>
    <div class="tracker tr-10"></div>
    <div class="tracker tr-11"></div>
    <div class="tracker tr-12"></div>
    <div class="tracker tr-13"></div>
    <div class="tracker tr-14"></div>
    <div class="tracker tr-15"></div>
    <div class="tracker tr-16"></div>
    <div class="tracker tr-17"></div>
    <div class="tracker tr-18"></div>
    <div class="tracker tr-19"></div>
    <div class="tracker tr-20"></div>
    <div class="tracker tr-21"></div>
    <div class="tracker tr-22"></div>
    <div class="tracker tr-23"></div>
    <div class="tracker tr-24"></div>
    <div class="tracker tr-25"></div>
    <div id="card">
    <p id="prompt"><img src="imgs/Equinox_logo.png">
    <legend style="text-align: center;">ABOUT US </legend>
		<div id="content">
     

		<legend style="text-align: center;"><h3>EQUINOX`S VISION</h3></legend>
					<h4 style="text-indent:60px; text-align: center;">To be the leading online car dealership in the world .</h4>
		
			<br />
			<legend style="text-align: center;"><h3>EQUINOX`S MISSION</h3></legend>
					<h4 style="text-indent:60px; text-align: center;">To provide High Quality cars at the best prices for people.</h4>
				
			<br />
            </p>

      <div class="subtitle">
   
      </div>
      
    </div>
  </div>
</div>