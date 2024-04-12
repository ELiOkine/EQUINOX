<?php
include('../settings/connection.php');

$id = $_POST['id'];

 mysqli_query($conn, "DELETE FROM car WHERE car_id = '$id'") or die(mysqli_connect_error());

?>