<?php
    include("settings/connection.php");
    include("settings/session.php");
?>
<html>
<head>
    <title>EQUINOX</title>
    <link rel="icon" href="imgs/Equinox_logo.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>

<div id="header">
    <img src="imgs/Equinox_logo.png">
    <label>EQUINOX</label>
        
        <?php
            $id = (int) $_SESSION['id'];
        
                $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die(mysqli_connect_error());
                $fetch = mysqli_fetch_array($query);
        ?>
    
        <ul>
            <li><a href="function/logout.php"><i class="icon-off icon-white"></i>LOG OUT</a></li>
            <li>WELCOME:<a href="#profile" data-toggle="modal"><i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname'];?></a></li>
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
        
                            $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die(mysqli_connect_error());
                            $fetch = mysqli_fetch_array($query);
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
                <li><a href="cars.php">  <i class="icon-th-list"></i>Cars</a></li>
                <li><a href="aboutus1.php">   <i class="icon-bookmark"></i>About Us</a></li>
                <li><a href="contactus.php"><i class="icon-inbox"></i>Contact Us</a></li>
            
            </ul>
    </div>
    
    <form method="post" class="well" style="background-color:#fff; overflow:hidden;">
        <table class="table" style="width:50%;">
        <label style="font-size:25px;">Car Order Summary</label>
            <tr>
                <th><h5>Quantity</h5></td>
                <th><h5>Car Name</h5></td>
                <th><h5>Seats</h5></td>
                <th><h5>Price</h5></td>
            </tr>
            
            <?php
            $t_id = $_GET['tid'];
            $query = mysqli_query($conn, "SELECT * FROM transaction WHERE transaction_id = '$t_id'") or die(mysqli_connect_error());
            $fetch = mysqli_fetch_array($query);
            
            $amnt = $fetch['amount'];
            $t_id = $fetch['transaction_id'];
            
            $query2 = mysqli_query($conn, "SELECT * FROM transaction_detail LEFT JOIN car ON car.car_id = transaction_detail.car_id WHERE transaction_detail.transaction_id = '$t_id'") or die(mysqli_connect_error());
            while($row = mysqli_fetch_array($query2)){
            
            $pname = $row['car_name'];
            $psize = $row['car_size'];
            $pprice = $row['car_price'];
            $oqty = $row['order_qty'];
            
            echo "<tr>";
            echo "<td>".$oqty."</td>";
            echo "<td>".$pname."</td>";
            echo "<td>".$psize."</td>";
            echo "<td>".$pprice."</td>";
            echo "</tr>";
            }
            ?>

    </table>
        <legend></legend>
        <h4>TOTAL COST: $ <?php echo $amnt; ?></h4>
        <h4> THANK YOU FOR YOUR PURCHASE</h4>
        <a href="home.php" class="btn btn-primary">Done</a>
    
    </form>
            
        
</div>
<br />
<br>
</div>
    <br>
    <div id="footer" style="position: absolute; bottom: 0; width: 100%;">
    <div class="foot">
        <p style="font-size:25px;">EQUINOX INCORPORATED</p>
    </div>
</div>
</body>
</html>
