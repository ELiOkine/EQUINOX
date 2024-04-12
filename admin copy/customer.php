<?php
	
	include("../settings/session.php");
	include("../settings/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>EQUINOX</title>
	<link rel="icon" href="../imgs/Equinox_logo.png">
	<link rel = "stylesheet" type = "text/css" href="../css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

</head>
<body>
	<div id="header" style="position:fixed;">
		<img src="../imgs/Equinox_logo.png">
		<label>EQUINOX</label>
		
			<?php
				$id = (int) $_SESSION['id'];
			
					$query = mysqli_query ($conn, "SELECT * FROM admin WHERE adminid = '$id' ") or die (mysqli_connect_error());
					$fetch = mysqli_fetch_array ($query);
			?>
				
			<ul>
				<li><a href="../function/admin_logout.php"><i class="icon-off icon-white"></i>LOG OUT</a></li>
				<li>WELCOME:<a><i class="icon-user icon-white"></i><?php echo $fetch['username']; ?></a></li>
			</ul>
	</div>
	
	<br>
	
	<div id="leftnav" style="background-color: lightblue;">
		<ul>
			<li><a href="admin_home.php" style="color:#333;">Dashboard</a></li>
			<li><a href="admin_home.php">Cars</a>
				<ul>
				
					<li><a href="admin_porsche.php "style="font-size:15px; margin-left:15px;">Porsche</a></li>
					<li><a href="admin_lamboghini.php" style="font-size:15px; margin-left:15px;">Lamboghini</a></li>
					<li><a href="admin_tesla.php"style="font-size:15px; margin-left:15px;">Tesla</a></li>
				</ul>
			</li>
			<li><a href="transaction.php">Transactions</a></li>
			<li><a href="customer.php">Customers</a></li>
			<li><a href="message.php">Messages</a></li>
			<li><a href="totalrevenue.php">Total revenue</a></li>
		</ul>
	</div>
	
	<div id="rightcontent" style="position:absolute; top:10%;">
			<div class="alert alert-info"><center><h2>EQUINOX`S Customers</h2></center></div>
			<br>
		
		<div class="alert alert-info">
			<table class="table table-hover" style="background-color:light purple;">
				<thead>
				<tr style="font-size:20px;">
					<th>Name</th>
					<th>Address</th>
					<th>Province</th>
					<th>Zipcode</th>
					<th>Mobile</th>
					<th>Email</th>
				</tr>
				
				</thead>
				<?php
					$query = mysqli_query($conn, "SELECT * FROM `customer`") or die(mysqli_connect_error());
					while($fetch = mysqli_fetch_array($query))
						{
				?>
				<tr>
					<td><?php echo $fetch['firstname'];?>&nbsp;<?php echo  $fetch['lastname'];?></td>
					<td><?php echo $fetch['address']?></td>
					<td><?php echo $fetch['country']?></td>
					<td><?php echo $fetch['zipcode']?></td>
					<td><?php echo $fetch['mobile']?></td>
					<td><?php echo $fetch['email']?></td>
				</tr>		
				<?php
					}
				?>
			</table>
		</div>
			
	</div>
	
	

</body>
</html>