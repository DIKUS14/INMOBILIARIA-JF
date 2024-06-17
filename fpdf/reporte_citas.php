<?php
header('Content-Type: text/html; charset=UTF-8');

require('fpdf.php');  
require_once('../crudinmuebles/conexion.php'); 

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 10, 'Reporte de Citas | Inmobiliaria JF', 0, 1, 'C');
$pdf->Ln(10);

$conexion = new mysqli("localhost", "root", "", "realstate");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$consulta = "SELECT * FROM tblcita";
$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    $pdf->SetFont('Arial', 'B', 10);

    // Encabezados de la tabla con anchos relativos
    $pdf->Cell(15, 10, 'ID', 1);
    $pdf->Cell(30, 10, 'Nombre Usuario', 1);
    $pdf->Cell(30, 10, 'Nombre Asesor', 1);
    $pdf->Cell(40, 10, utf8_decode('Dirección'), 1);
    $pdf->Cell(25, 10, utf8_decode('Fecha'), 1);
    $pdf->Cell(20, 10, utf8_decode('Hora'), 1);
    $pdf->Cell(25, 10, utf8_decode('Teléfono'), 1);
    $pdf->Cell(25, 10, utf8_decode('Código'), 1);
    $pdf->Cell(40, 10, utf8_decode('Info Inmueble'), 1);
    $pdf->Cell(25, 10, 'Precio Final', 1);
    $pdf->Ln();


    $pdf->SetFont('Arial', '', 10);
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(15, 10, $fila['IdCita'], 1);
        $pdf->Cell(30, 10, $fila['Nombre_usuario'], 1);
        $pdf->Cell(30, 10, $fila['Nombre_asesor'], 1);
        $pdf->Cell(40, 10, $fila['Dirección'], 1);
        $pdf->Cell(25, 10, utf8_decode($fila['Fecha']), 1);
        $pdf->Cell(20, 10, utf8_decode($fila['Hora']), 1);
        $pdf->Cell(25, 10, utf8_decode($fila['Telefono']), 1);
        $pdf->Cell(25, 10, utf8_decode($fila['codigoc']), 1);
        $pdf->Cell(40, 10, utf8_decode($fila['infoinmueble']), 1);
        $pdf->Cell(25, 10, $fila['Precio_final'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron citas.', 1, 1, 'C');
}

// Aquí mostramos el PDF en lugar de descargarlo
$pdf->Output('D', 'reporte_citas.pdf');

$conexion->close();
?>
