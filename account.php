<?php
	include("settings/session.php");
	include("settings/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>EQUINOX</title>
    <link rel="icon" href="imgs/Equinox_logo.png">
	<link rel = "stylesheet" type = "text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	
	<script src="js/button.js"></script>
	<script src="js/dropdown.js"></script>

	<script src="js/alert.js"></script>
	<script src="js/transition.js"></script>
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
				<li><a href="#profile" href  data-toggle="modal">WELCOME:<i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname'];?></a></li>
			</ul>	
	</div>
	<div id="container">
    <?php
    $id = (int) $_SESSION['id'];
    $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id'") or die(mysqli_connect_error());
    $fetch = mysqli_fetch_array($query);

    $firstname = $fetch['firstname'];
    $lastname = $fetch['lastname'];
    $address = $fetch['address'];
    $country = $fetch['country'];
    $zipcode = $fetch['zipcode'];
    $mobile = $fetch['mobile'];
    $email = $fetch['email'];
    ?>

    <div id="account">
        <form method="POST" action="function/edit_customer.php">
            <center>
                <h3>My Personal Info</h3>
                <table>
                    <tr>
                        <td>Firstname:</td>
                        <td><input type="text" name="firstname" placeholder="Firstname" required value="<?php echo htmlspecialchars($firstname); ?>"></td>
                    </tr>
                    <tr>
                        <td>Lastname:</td>
                        <td><input type="text" name="lastname" placeholder="Lastname" required value="<?php echo htmlspecialchars($lastname); ?>"></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input type="text" name="address" placeholder="Address" required value="<?php echo htmlspecialchars($address); ?>"></td>
                    </tr>
                    <tr>
                        <td>Province:</td>
                        <td><input type="text" name="country" placeholder="Province" required value="<?php echo htmlspecialchars($country); ?>"></td>
                    </tr>
                    <tr>
                        <td>ZIP Code:</td>
                        <td><input type="text" name="zipcode" placeholder="ZIP Code" required value="<?php echo htmlspecialchars($zipcode); ?>" maxlength="4"></td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td><input type="text" name="mobile" placeholder="Mobile Number" value="<?php echo htmlspecialchars($mobile); ?>" maxlength="11"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="edit" value="Save Changes" class="btn btn-primary">
                            &nbsp;<a href="home.php"><input type="button" name="cancel" value="Cancel" class="btn btn-danger"></a>
                        </td>
                    </tr>
                </table>
            </center>
        </form>
    </div>
</div>
						
			
	<br>

</div>
</body>
</html>