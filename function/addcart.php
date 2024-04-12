<?php

if (isset($_POST['add'])) {
    include('../settings/connection.php'); // Include your database connection file

    // Sanitize inputs to prevent SQL injection
    $car_id = mysqli_real_escape_string($conn, $_POST['car_id']);
    $cust_id = mysqli_real_escape_string($conn, $_POST['customerid']);

    // Perform the query
    $query = "INSERT INTO cart (car_id, cust_id) VALUES ('$car_id', '$cust_id')";
    if (mysqli_query($conn, $query)) {
        header("location: cars.php");
        exit; 
    } else {
        die("Error: " . mysqli_error($conn));
    }
}

?>
