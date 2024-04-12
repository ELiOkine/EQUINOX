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
	
	<div id="leftnav" style="background-color: lightblue;">
		<ul>
			<li><a href="admin_home.php" style="color:#333;">Dashboard</a></li>
			<li><a href="admin_home.php">Cars</a>
				<ul>
					<li><a href="admin_porsche.php "style="font-size:15px; margin-left:15px;">porsche</a></li>
					<li><a href="admin_lamboghini.php "style="font-size:15px; margin-left:15px;">lamboghini</a></li>
					<li><a href="admin_tesla.php" style="font-size:15px; margin-left:15px;">tesla</a></li>
				
				</ul>
			</li>
			<li><a href="transaction.php">Transactions</a></li>
			<li><a href="customer.php">Customers</a></li>
			<li><a href="message.php">Messages</a></li>
			<li><a href="totalrevenue.php">Total revenue</a></li>
		</ul>
	</div>
	<div id="rightcontent" style="position:absolute; top:10%;">
	
	<div id="container" style="min-width: 310px; height: 600px; max-width: 1000px; margin: 0 auto; background:none; float:left;"></div>

	
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        <?php
        include("settings/connection.php");

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT car.car_name, stock.quantity FROM stock JOIN car ON stock.car_id = car.car_id");
        $stmt->execute();
        $result = $stmt->get_result();

        // Create the data table
        $data = array(array('Car', 'Quantity'));
        while ($row = $result->fetch_assoc()) {
          $data[] = array($row['car_name'], (int)$row['quantity']);
        }

        $stmt->close();
        $conn->close();
        ?>

        var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

        var options = {
          title: 'Car Stock Quantities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>

	
	</div>

</body>
</html>
