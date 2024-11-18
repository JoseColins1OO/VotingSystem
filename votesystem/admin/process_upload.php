<?php
include 'includes/session.php';
include 'includes/conn.php'; // Asegúrate de que la ruta sea correcta

if (isset($_POST['importSubmit'])) {

    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            fgetcsv($csvFile); // omitir encabezado

            while (($line = fgetcsv($csvFile)) !== false) {

                // Asignar valores de cada columna del CSV
                $voters_id  = $line[1];  // Primer columna: voters_id
                $password   = $line[2];  // Segunda columna: password
                $firstname  = $line[3];  // Tercera columna: firstname
                $lastname   = $line[4];  // Cuarta columna: lastname
                $photo      = $line[5];  // Quinta columna: photo

                // Comprobar si el 'voters_id' ya existe en la base de datos
                $prevQuery = "SELECT id FROM voters WHERE voters_id = '".$line[0]."'";
                $prevResult = $conn->query($prevQuery);

                // Si el 'voters_id' ya existe, se actualizan los datos
                if ($prevResult->num_rows > 0) {
                    $conn->query("UPDATE voters SET password = '".$password."', firstname = '".$firstname."', lastname = '".$lastname."', photo = '".$photo."' WHERE voters_id = '".$voters_id."'");
                } else {
                    // Si el 'voters_id' no existe, se insertan los nuevos datos
                    $conn->query("INSERT INTO voters (voters_id, password, firstname, lastname, photo) VALUES ('".$voters_id."', '".$password."', '".$firstname."', '".$lastname."', '".$photo."')");
                }

            }

            fclose($csvFile);

            $qstring = '?status=succ';

        } else {
            $qstring = '?status=err';
        }

    } else {
        $qstring = '?status=invalid_file';
    }

}

header('Location: voters.php');
?>
