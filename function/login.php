<?php
include('settings/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Server-side email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        session_start();
        $_SESSION['id'] = $row['customerid'];
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
        header("Location: home.php");
        exit();
    }

    $stmt->close();
}
?>