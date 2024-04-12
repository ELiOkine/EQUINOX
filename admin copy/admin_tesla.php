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

	
	
		<!--Le Facebox-->
		<link href="../dialoguefile/facebox.css" media="screen" rel="stylesheet" type="text/css" />
		<script src="../facefiles/jquery-1.9.js" type="text/javascript"></script>
		<script src="../facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
		<script src="../dialoguefile/facebox.js" type="text/javascript"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
		$('a[rel*=facebox]').facebox() 
		})
		</script>
	

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
				<li>WELCOME:<i class="icon-user icon-white"></i><?php echo $fetch['username']; ?></a></li>
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
			<div class="alert alert-info"><center><h2>Porche</h2></center></div>
			
			
		<div class="alert alert-info">
			<table class="table table-hover" style="background-color:light blue">
				<thead>
				<tr style="font-size:20px;">
					<th>car Image</th>
					<th>car Name</th>
					<th>car Price</th>
					<th>car Sizes</th>
					<th>No.in Stock</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
					
					$query = mysqli_query($conn, "SELECT * FROM `car` WHERE brand ='tesla' ORDER BY car_id DESC") or die(mysqli_connect_error());
					while($fetch = mysqli_fetch_array($query))
						{
						$id = $fetch['car_id'];
				?>
				<tr class="del<?php echo $id?>">
					<td><img class="img-polaroid" src = "../imgs/<?php echo $fetch['car_image']?>" height = "70px" width = "80px"></td>
					<td><?php echo $fetch['car_name']?></td>
					<td><?php echo $fetch['car_price']?></td>
					<td><?php echo $fetch['car_size']?></td>
					
					<?php
					$query1 = mysqli_query($conn, "SELECT * FROM `stock` WHERE car_id='$id'") or die(mysqli_connect_error());
					$fetch1 = mysqli_fetch_array($query1);
					
						$quantity = $fetch1['quantity'];
					?>
					
					<td><?php echo $fetch1['quantity']?></td>
					<td style="width:220px;">
					<?php
					echo "<a href='stock_in.php?id=".$id."' class='btn btn-success' rel='facebox'><i class='icon-plus-sign icon-white'></i>Stock In</a> ";
					echo "<a href='stock_out.php?id=".$id."' class='btn btn-danger' rel='facebox'><i class='icon-minus-sign icon-white'></i>Stock Out</a>";
					?>
					</td>
				</tr>		
				<?php
					}
				?>
				</tbody>
			</table>
		</div>	
  <?php
  /* stock in */
  if(isset($_POST['stockin'])){
  
  $pid = $_POST['pid'];
  
 $result = mysqli_query($conn, "SELECT * FROM `stock` WHERE car_id='$pid'") or die(mysqli_connect_error());
 $row = mysqli_fetch_array($result);
 
  $old_stck = $row['quantity'];
  $new_stck = $_POST['new_stck'];
  $total = $old_stck + $new_stck;
 
  $que = mysqli_query($conn, "UPDATE `stock` SET `quantity` = '$total' WHERE `car_id`='$pid'") or die(mysqli_connect_error());
  
  header("Location:admin_tesla.php");
 }
 
  /* stock out */
 if(isset($_POST['stockout'])){
  
  $pid = $_POST['pid'];
  
 $result = mysqli_query($conn, "SELECT * FROM `stock` WHERE car_id='$pid'") or die(mysqli_connect_error());
 $row = mysqli_fetch_array($result);
 
  $old_stck = $row['quantity'];
  $new_stck = $_POST['new_stck'];
  $total = $old_stck - $new_stck;
 
  $que = mysqli_query($conn, "UPDATE `stock` SET `quantity` = '$total' WHERE `car_id`='$pid'") or die(mysqli_connect_error());
  
  header("Location:admin_tesla.php");
 }
  ?>				
			
	
			
</body>
</html>
<script type="text/javascript">
	$(document).ready( function() {
		
		$('.remove').click( function() {
		
		var id = $(this).attr("id");

		
		if(confirm("Are you sure you want to delete this car?")){
			
		
			$.ajax({
			type: "POST",
			url: "../function/remove.php",
			data: ({id: id}),
			cache: false,
			success: function(html){
			$(".del"+id).fadeOut('slow', function(){ $(this).remove();}); 
			}
			}); 
			}else{
			return false;}
		});				
	});

</script>