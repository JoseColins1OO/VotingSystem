<?php
include 'includes/session.php';
require('includes/fpdf.php');

// Crear una instancia de FPDF
class PDF extends FPDF {
    // Cabecera del reporte
    function Header() {
        $this->Image('../images/Baner.png', 10, 10, 30); // Ajusta la posición y tamaño según sea necesario
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Votaciones', 0, 1, 'C');
        $this->Ln(5);
    }

  // Pie de página
  function Footer() {
    $this->SetY(-25);
    $this->SetFont('Arial', 'I', 10);
    
    // Fecha de creación del PDF
    $this->Cell(0, 10, 'Fecha de creacion: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
    
    // Token de seguridad
    $this->Cell(0, 10, 'Token: ' . $this->token, 0, 0, 'C');
}

// Establecer token de seguridad
function setToken($token) {
    $this->token = $token;
}
}
// Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Generar el token de seguridad
$token = bin2hex(random_bytes(16));  // Genera un token aleatorio de 32 caracteres

// Conectar a la base de datos y obtener los datos de la vista
$conn = new mysqli('localhost', 'root', '', 'votesystem'); // Cambia por tus credenciales
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM votaciones_reporte";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Títulos de las columnas
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Posicion', 1);
    $pdf->Cell(60, 10, 'Candidato', 1);
    $pdf->Cell(30, 10, 'Votos', 1);
    $pdf->Cell(40, 10, 'Total Posicion', 1);
    $pdf->Ln();

    // Filas de datos
    $pdf->SetFont('Arial', '', 12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, utf8_decode($row['posicion']), 1);
        $pdf->Cell(60, 10, utf8_decode($row['nombre_candidato'] . ' ' . $row['apellido_candidato']), 1);
        $pdf->Cell(30, 10, $row['votos_recibidos'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['total_votos_posicion'], 1, 0, 'C');
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron datos', 1, 1, 'C');
}

// Establecer el token en el PDF
$pdf->setToken($token);

// Descargar el PDF
$pdf->Output('D', 'Reporte_Votaciones.pdf');

// Guardar el token en la base de datos
$sql = "INSERT INTO registro_reportes (token) VALUES ('$token')";
$conn->query($sql);

$conn->close();
?>