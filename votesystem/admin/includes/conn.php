<?php
	$conn = new mysqli('localhost', 'root', '', 'votesystem');

	if ($conn->connect_error) {
	    die("Error en la conexion de la BD: " . $conn->connect_error);
	}
	
?>