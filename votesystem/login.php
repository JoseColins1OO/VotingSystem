<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$voter = $_POST['voter'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'No se encontró al usuari con el numero de cuenta proporcionado';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['voter'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Contrasenia invalida';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Ingrese las credenciales de los votantes primero';
	}

	header('location: index.php');

?>