<?php
	$conn = mysqli_connect("localhost", "root", "", "Equinox");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
