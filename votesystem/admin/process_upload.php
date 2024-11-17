<?php
include 'includes/session.php';

// Configurar error_log para redirigir errores a stderr
ini_set('log_errors', 'On');
ini_set('error_log', 'php://stderr');

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Validar que el archivo sea CSV
    $file_type = mime_content_type($_FILES['file']['tmp_name']);
    $allowed_types = ['text/csv', 'application/vnd.ms-excel'];
    if (!in_array($file_type, $allowed_types)) {
        $error_message = 'Solo se permiten archivos CSV.';
        error_log($error_message); // Redirigir error a stderr
        $_SESSION['error'] = $error_message;
        header('Location: UploadData.php');
        exit();
    }

    // Leer el archivo CSV
    $file = fopen($_FILES['file']['tmp_name'], 'r');

    // Saltar la primera línea si contiene encabezados
    $headers = fgetcsv($file);

    // Procesar las líneas del CSV
    while (($row = fgetcsv($file)) !== false) {
        // Asumiendo que el archivo tiene columnas en este orden: no_cuenta, firstname, lastname, password
        $no_cuenta = $row[0];
        $firstname = $row[1];
        $lastname = $row[2];
        $password = password_hash($row[3], PASSWORD_DEFAULT); // Encriptar la contraseña

        // Generar voters_id único
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $voters_id = substr(str_shuffle($set), 0, 15);

        // Insertar en la base de datos
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname) VALUES ('$no_cuenta', '$password', '$firstname', '$lastname')";
        if (!$conn->query($sql)) {
            // Manejo de errores si no se puede insertar una fila
            $error_message = "Error al insertar fila: " . $conn->error;
            error_log($error_message); // Redirigir error a stderr
        }
    }

    // Cerrar el archivo
    fclose($file);

    $_SESSION['success'] = 'Los datos del archivo CSV fueron cargados correctamente.';
} else {
    $error_message = 'No se seleccionó ningún archivo o hubo un error al cargarlo.';
    error_log($error_message); // Redirigir error a stderr
    $_SESSION['error'] = $error_message;
}

header('Location: UploadData.php');
?>
