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

	
	
		<link href="../facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
		<script src="../facefiles/jquery-1.9.js" type="text/javascript"></script>
		<script src="../facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
		<script src="../facefiles/facebox.js" type="text/javascript"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
		$('a[rel*=facebox]').facebox() 
		})
		</script>
		
		<script language="javascript" type="text/javascript">
        function printFunc(divID) {
         
            var divElements = document.getElementById(divID).innerHTML;
          
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
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
				<li><a href="../function/admin_logout.php"><i class="icon-off icon-white"></i>lOG OUT</a></li>
				<li>WELCOME:<i class="icon-user icon-white"></i><?php echo $fetch['username']; ?></a></li>
			</ul>
	</div>
	
	<br>

		
		<div id="add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Add car...</h3>
			</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data">
					<center>
						<table>
							<tr>
								<td><input type="file" name="car_image" required></td>
							</tr>
							<?php include("random_id.php"); 
							echo '<tr>
								<td><input type="hidden" name="car_code" value="'.$code.'" required></td>
							<tr/>';
							?>
							<tr>
								<td><input type="text" name="car_name" placeholder="car Name" style="width:250px;" required></td>
							<tr/>
							<tr>
								<td><input type="text" name="car_price" placeholder="Price" style="width:250px;" required></td>
							</tr>
							<tr>
								<td><input type="text" name="car_size" placeholder="Size" style="width:250px;" maxLength="2" required></td>
							</tr>
							<tr>
								<td><input type="text" name="brand" placeholder="Brand Name	" style="width:250px;" required></td>
							</tr>
							<tr>
								<td><input type="number" name="qty" placeholder="No. of Stock" style="width:250px;" required></td>
							</tr>
							<tr>
								<td><input type="hidden" name="category" value="basketball"></td>
							</tr>
						</table>
					</center>
				</div>
			<div class="modal-footer">
				<input class="btn btn-primary" type="submit" name="add" value="Add">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
					</form>
			</div>
		</div>
		
		<?php
			if (isset($_POST['add']))
				{
					$car_code = $_POST['car_code'];
					$car_name = $_POST['car_name'];
					$car_price = $_POST['car_price'];
					$car_size = $_POST['car_size'];
					$brand = $_POST['brand'];
					$category = $_POST['category'];
					$qty = $_POST['qty'];
					$code = rand(0,98987787866533499);
						
								$name = $code.$_FILES["car_image"] ["name"];
								$type = $_FILES["car_image"] ["type"];
								$size = $_FILES["car_image"] ["size"];
								$temp = $_FILES["car_image"] ["tmp_name"];
								$error = $_FILES["car_image"] ["error"];
										
								if ($error > 0){
									die("Error uploading file! Code $error.");}
								else
								{
									if($size > 30000000000) //conditions for the file
									{
										die("Format is not allowed or file size is too big!");
									}
									else
									{
										move_uploaded_file($temp,"../imgs/".$name);
			

				$q1 = mysqli_query($conn, "INSERT INTO car ( car_id,car_name, car_price, car_size, car_image, brand, category)
				VALUES ('$car_code','$car_name','$car_price','$car_size','$name', '$brand', '$category')");
				
				$q2 = mysqli_query($conn, "INSERT INTO stock ( car_id, qty) VALUES ('$car_code','$qty')");
				
				header ("location:admin_porsche.php");
			}}
		}

				?>
			
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
			<li><a href="totalrevenue.php">TotalRevenue</a></li>
		</ul>
	</div>
	
	<div id="rightcontent" style="position:absolute; top:10%;">
			<div class="alert alert-info"><center><h2>EQUINOX`S TOTAL REVENUE</h2></center></div>
			<br />
				<div style='width:975px;' class="alert alert-info">
					  <table class="table table-hover">	
						<thead>	
							<th>Car</th>
							<th>Transaction Number.</th>
							<th>Total Amount </th>
						</thead>
						  <tbody>
							<?php 
							$Q1 = mysqli_query($conn, "SELECT * FROM transaction WHERE order_stat = 'Confirmed'");
							while($r1 = mysqli_fetch_array($Q1)){
							
							$tid = $r1['transaction_id'];
							
							$Q2 = mysqli_query($conn, "SELECT * FROM transaction_detail LEFT JOIN car ON car.car_id = transaction_detail.car_id WHERE transaction_detail.transaction_id = '$tid' ");
							$r2 = mysqli_fetch_array($Q2);
							
							$pid = $r2['car_id'];
							$o_qty = $r2['order_qty'];
							
							$p_price = $r2['car_price'];
							$brand = $r2['car_name'];
							
							echo "<tr>";
							echo "<td>".$brand."</td>";
							echo "<td>".$tid."</td>";
							echo "<td>".formatMoney($p_price)."</td>";
							echo "</tr>";
							}
							
							$Q3 = mysqli_query($conn, "SELECT sum(amount) FROM transaction WHERE order_stat = 'Confirmed'");
							while($r3 = mysqli_fetch_array($Q3)){
							
							$amnt = $r3['sum(amount)'];
							echo "<tr><td></td><td> AMOUNT : </td> <td><b> $ ".formatMoney($amnt)."</b></td></tr>";
							}
							?>
						  </tbody>
					    </table>
				</div>
				
				<?php
function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}
?>



	
	
	</div>
	</form>
			
			
				
			
</body>
</html>