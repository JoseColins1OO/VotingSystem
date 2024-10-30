<?php
	include 'includes/session.php';

	$sql = "DELETE FROM votes";
	if($conn->query($sql)){
		$_SESSION['success'] = "Los votos se han restablecido";
	}
	else{
		$_SESSION['error'] = "Error al restablecer";
	}

	header('location: votes.php');

?>