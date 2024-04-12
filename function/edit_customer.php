<?php

		include ("../settings/connection.php");
		include ("../settings/session.php");
		
		
		// Get the customer ID from the session
		$id = (int) $_SESSION['id'];
		
		// Sanitize and prepare the user input
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$country = mysqli_real_escape_string($conn, $_POST['country']);
		$zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
		$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		
		
		$stmt = $conn->prepare("UPDATE customer SET firstname = ?, lastname = ?, address = ?, country = ?, zipcode = ?, mobile = ?, email = ? WHERE customerid = ?");
		$stmt->bind_param("sssssssi", $firstname, $lastname, $address, $country, $zipcode, $mobile, $email, $id);
		
		if ($stmt->execute()) {
			// Redirect the user to the account.php page
			header("Location: ../account.php");
			exit();
		} else {
			echo "Error updating customer information: " . $stmt->error;
		}
		
		// Close the statement and connection
		$stmt->close();
		$conn->close();
		?>
		
	?>