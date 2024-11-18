<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$voters_id = $_POST['no_cuenta'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$email = $_POST['correo'];

		$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email) VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$email')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Usuario agregado';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Debe completar el formulario';
	}

	header('location: voters.php');
?>