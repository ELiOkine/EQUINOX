<?php
include("settings/session.php");
include("settings/connection.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>EQUINOX</title>
    <link rel="icon" href="imgs/Equinox_logo.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/contactus.css">
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

        $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die(mysqli_connect_error());
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

            $query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ") or die(mysqli_connect_error());
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
        <div class="nav">
            <ul>
            <li><a href="home.php"><i class="icon-home" ></i>Home</a></li>
					<li><a href="cars.php"><i class="icon-th-list"></i>Cars</a></li>
					<li><a href="aboutus1.php"><i class="icon-bookmark"></i>About Us</a></li>
					<li><a href="contactus.php"><i class="icon-inbox"></i>Contact Us</a></li>

            </ul>
        </div>
        <br>
        <br>
        <br>
        <br>




        <div class="form-container" style="position:relative; left:25%;">
    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="email">Email</label>
            <td><input type="email" name="email" value="<?php echo $fetch['email']; ?>" style="width:420px;" ></td>
        </div>
        <div class="form-group">
            <label for="textarea">send us a message</label>
            <textarea required cols="50" rows="10" id="textarea" name="message"></textarea>
        </div>
        <?php
        if (isset($_POST['send'])) {
            $email = $_POST['email'];
            $message = $_POST['message'];
            $sql = "INSERT INTO `contact` (email, message) VALUES ('$email', '$message')";
            if (mysqli_query($conn, $sql)) {
                echo "Message sent successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>
        <button type="submit" name="send" class="form-submit-btn">Submit</button>
    </form>
</div>







    </div>
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