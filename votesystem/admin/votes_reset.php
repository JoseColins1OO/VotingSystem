<?php
	include 'includes/session.php';

	$sql = "DELETE FROM votes";
	if($conn->query($sql)){
		$_SESSION['success'] = "Los votos se restablecieron exitosamente";
	}
	else{
		$_SESSION['error'] = "Algo salió mal al restablecer";
	}

	header('location: votes.php');

?>