<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];

		// Use prepared statement to prevent SQL injection
		$stmt = $conn->prepare("INSERT INTO members (firstname, lastname, address) VALUES (?, ?, ?)");
		if ($stmt) {
			$stmt->bind_param("sss", $firstname, $lastname, $address);

			if($stmt->execute()){
				$_SESSION['success'] = 'Member added successfully';
			} else {
				$_SESSION['error'] = 'Error: ' . $stmt->error;
			}

			$stmt->close();
		} else {
			$_SESSION['error'] = 'Prepare failed: ' . $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: index.php');
?>
