<?php
	include 'includes/session.php';

	$return = 'home.php';
	if(isset($_GET['return'])){
		$return = $_GET['return'];
	}

	if(isset($_POST['save'])){
		$title = $_POST['title'];

		$file = 'config.ini';
		$content = 'election_title = '.$title;

		file_put_contents($file, $content);

		$_SESSION['success'] = 'Título de la elección actualizado exitosamente';
		
	}
	else{
		$_SESSION['error'] = "Complete primero el formulario";
	}

	header('location: '.$return);

?>