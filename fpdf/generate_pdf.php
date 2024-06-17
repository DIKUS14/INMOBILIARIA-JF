<?php
session_start();
include '../crudinmuebles/conexion.php'; // Ajusta esto a la ruta correcta de tu archivo de conexión

require('fpdf.php'); 

class PDF extends FPDF
{
   // Cabecera de la página
   function Header()
   {
       // Inserta el logo
       $this->Image('../imagenes/LOGO JF cuadro.png', 10, 6, 30); // Ruta, posición x, posición y, tamaño

       // Establece la fuente para el título
       $this->SetFont('Arial', 'B', 12);

       // Mueve hacia la derecha (para que el texto no se superponga con el logo)
       $this->Cell(40); // Ajusta este valor según sea necesario

       // Título de la cabecera
       $this->Cell(0, 10, 'Lista de Usuarios', 0, 1, 'C');
       $this->Ln(10);
   }
}

// Crear un nuevo PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Consultar los datos de la tabla tblusuarios
$consulta = "SELECT * FROM tblusuarios";
$resultado = $con->query($consulta);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Nombres', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Correo', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Rol', 1, 0, 'C', true);
    $pdf->Ln();
    
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(10, 10, $fila['id'], 1);
        $pdf->Cell(40, 10, $fila['Nombres'], 1);
        $pdf->Cell(60, 10, $fila['Correo'], 1);
        $pdf->Cell(30, 10, $fila['rol'], 1);
        $pdf->Ln();
    }
}

// Salida del PDF al navegador
$pdf->Output('D', 'usuarios.pdf');
?>
