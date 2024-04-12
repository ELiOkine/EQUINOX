<?php

include("../settings/session.php");
include("../settings/connection.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>EQUINOX</title>
	<link rel="icon" href="../imgs/Equinox_logo.png">
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
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
</head>

<body>
	<div id="header" style="position:fixed;">
		<img src="../imgs/Equinox_logo.png">
		<label>EQUINOX</label>

		<?php
		$id = (int) $_SESSION['id'];

		$query = mysqli_query($conn, "SELECT * FROM admin WHERE adminid = '$id' ") or die(mysqli_connect_error());
		$fetch = mysqli_fetch_array($query);
		?>

		<ul>
			<li><a href="../function/admin_logout.php"><i class="icon-off icon-white"></i>LOG OUT</a></li>
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
								<td><input type="hidden" name="car_code" value="' . $code . '" required></td>
							<tr/>';
						?>
						<tr>
							<td><input type="text" name="car_name" placeholder="car Name" style="width:250px;" required></td>
							<tr />
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
							<td><input type="number" name="quantity" placeholder="No. of Stock" style="width:250px;" required></td>
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
	if (isset($_POST['add'])) {
		$car_code = $_POST['car_code'];
		$car_name = $_POST['car_name'];
		$car_price = $_POST['car_price'];
		$car_size = $_POST['car_size'];
		$brand = $_POST['brand'];
		$category = $_POST['category'];
		$quantity = $_POST['quantity'];
		$code = rand(0, 98987787866533499);

		$name = $code . $_FILES["car_image"]["name"];
		$type = $_FILES["car_image"]["type"];
		$size = $_FILES["car_image"]["size"];
		$temp = $_FILES["car_image"]["tmp_name"];
		$error = $_FILES["car_image"]["error"];

		if ($error > 0) {
			die("Error uploading file! Code $error.");
		} else {
			if ($size > 90000000000) {
				die("Format is not allowed or file size is too big!");
			} else {
				move_uploaded_file($temp, "../imgs/" . $name);


				$q1 = mysqli_query($conn, "INSERT INTO car ( car_id,car_name, car_price, car_size, car_image, brand)
				VALUES ('$car_code','$car_name','$car_price','$car_size','$name', '$brand')");

				$q2 = mysqli_query($conn, "INSERT INTO stock ( car_id, quantity) VALUES ('$car_code','$quantity')");

				header("location:admin_porsche.php");
			}
		}
	}

	?>

<div id="leftnav" style="background-color: lightblue;">
		<ul>
			<li><a href="admin_home.php" style="color:#333;">Dashboard</a></li>
			<li><a href="admin_home.php">Cars</a>

				<ul>

					<li><a href="admin_porsche.php " style="font-size:15px; margin-left:15px;">Porsche</a></li>
					<li><a href="admin_lamboghini.php" style="font-size:15px; margin-left:15px;">Lamboghini</a></li>
					<li><a href="admin_tesla.php" style="font-size:15px; margin-left:15px;">Tesla</a></li>
				</ul>
			</li>
			<li><a href="transaction.php">Transactions</a></li>
			<li><a href="customer.php">Customers</a></li>
			<li><a href="message.php">Messages</a></li>
			<li><a href="totalrevenue.php">Total Revenue</a></li>
		</ul>
	</div>

	<div id="rightcontent" style="position:absolute; top:10%;">
		<div class="alert alert-info">
			<center>
				<h2>Transactions </h2>
			</center>
		</div>
		<br>

		<div class="alert alert-info">
			<table class="table table-hover" style="background-color: light blue">
				<thead>
					<tr style="font-size:16px;">
						<th>ID</th>
						<th>DATE</th>
						<th>Customer Name</th>
						<th>Total Amount</th>
						<th>Order Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query = mysqli_query($conn, "SELECT * FROM transaction LEFT JOIN customer ON customer.customerid = transaction.customerid") or die(mysqli_connect_error());
					while ($fetch = mysqli_fetch_array($query)) {
						$id = $fetch['transaction_id'];
						$amnt = $fetch['amount'];
						$o_stat = $fetch['order_stat'];
						$o_date = $fetch['order_date'];

						$name = $fetch['firstname'] . ' ' . $fetch['lastname'];
					?>
						<tr>
							<td><?php echo $id; ?></td>
							<td><?php echo $o_date; ?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo $amnt; ?></td>
							<td><?php echo $o_stat; ?></td>
							<td><a href="receipt.php?tid=<?php echo $id; ?>">View</a>
								<?php
								if ($o_stat == 'Confirmed') {
								} elseif ($o_stat == 'Cancelled') {
								} else {
									echo '| <a class="btn btn-mini btn-info" href="confirm.php?id=' . $id . '">Confirm</a> ';
									echo '| <a class="btn btn-mini btn-danger" href="cancel.php?id=' . $id . '">Cancel</a></td>';
								}
								?>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<?php
	/* stock in */
	if (isset($_POST['stockin'])) {

		$pid = $_POST['pid'];

		$result = mysqli_query($conn, "SELECT * FROM `stock` WHERE car_id='$pid'") or die(mysqli_connect_error());
		$row = mysqli_fetch_array($result);

		$old_stck = $row['quantity'];
		$new_stck = $_POST['new_stck'];
		$total = $old_stck + $new_stck;

		$que = mysqli_query($conn, "UPDATE `stock` SET `quantity` = '$total' WHERE `car_id`='$pid'") or die(mysqli_connect_error());

		header("Location:admin_porsche.php");
	}

	/* stock out */
	if (isset($_POST['stockout'])) {

		$pid = $_POST['pid'];

		$result = mysqli_query($conn, "SELECT * FROM `stock` WHERE car_id='$pid'") or die(mysqli_connect_error());
		$row = mysqli_fetch_array($result);

		$old_stck = $row['quantity'];
		$new_stck = $_POST['new_stck'];
		$total = $old_stck - $new_stck;

		$que = mysqli_query($conn, "UPDATE `stock` SET `quantity` = '$total' WHERE `car_id`='$pid'") or die(mysqli_connect_error());

		header("Location:admin_porsche.php");
	}
	?>

</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {

		$('.remove').click(function() {

			var id = $(this).attr("id");


			if (confirm("Are you sure you want to delete this car?")) {


				$.ajax({
					type: "POST",
					url: "../function/remove.php",
					data: ({
						id: id
					}),
					cache: false,
					success: function(html) {
						$(".del" + id).fadeOut(2000, function() {
							$(this).remove();
						});
					}
				});
			} else {
				return false;
			}
		});
	});
</script>