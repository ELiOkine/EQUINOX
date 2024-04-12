<!DOCTYPE html>
<html>
<head>
	<title>EQUINOX</title>
	<link rel="icon" href="../imgs/Equinox_logo.png">
	<link rel = "stylesheet" type = "text/css" href="../css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	
</head>
<body>
	<div id="header">
		<img src="../imgs/Equinox_logo.png">
		<label>EQUINOX</label>
	</div>
	
		<?php include('../function/admin_login.php');?>
	<div id="admin">
		<form method="post" class="well">
			<center>
				<legend>EQUINOX Adminstrator</legend>
					<table>
						<tr>
							<input type="text" name="username" placeholder="Username">
						</tr>
						<tr>
							<input type="password" name="password" placeholder="Password">
						</tr>
						<br>
						<br>
							<input type="submit" name="enter" value="login" class="btn btn-primary" style="width:200px;">
					</table>
			</center>
		</form>
	</div>
	

</div>

</body>
</html>