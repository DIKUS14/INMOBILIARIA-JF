<?php
require('fpdf.php');  // Ajusta la ruta según tu estructura de directorios
require_once('../crudsolicitudes/conne.php');
require_once('../crudsolicitudes/controller_solicitud.php');

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Encabezado
$pdf->Cell(0, 10, 'Reporte de Solicitudes de Cita | Inmobiliaria JF', 0, 1, 'C');
$pdf->Ln(10);

// Obtener datos de la base de datos
$conexion = new Conexion();
$manejadorSolicitudes = new ManejadorSolicitudes($conexion->con);
$solicitudes = $manejadorSolicitudes->obtenerSolicitudes();

// Definir encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(50, 10, 'Nombre Completo', 1);
$pdf->Cell(30, 10, 'Telefono', 1);
$pdf->Cell(50, 10, 'Correo Electronico', 1);
$pdf->Cell(50, 10, 'ID Inmueble Interes', 1);
$pdf->Ln();

// Agregar datos a la tabla
$pdf->SetFont('Arial', '', 10);
if (!empty($solicitudes)) {
    foreach ($solicitudes as $solicitud) {
        $pdf->Cell(10, 10, $solicitud['idSolicitud'], 1);
        $pdf->Cell(50, 10, $solicitud['Nombre'], 1);
        $pdf->Cell(30, 10, $solicitud['Telefono'], 1);
        $pdf->Cell(50, 10, $solicitud['Correo'], 1);
        $pdf->Cell(50, 10, $solicitud['idInmuebleInteres'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron solicitudes.', 1, 1, 'C');
}

// Salida del PDF
$pdf->Output('D', 'reporte_solicitudes.pdf');
?>
