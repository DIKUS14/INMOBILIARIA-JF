<?php
require_once('conne.php');
require_once('controller_solicitud.php');
include '../pagina_html/funciones.php';

$conexion = new Conexion();
$manejadorSolicitudes = new ManejadorSolicitudes($conexion->con);

$solicitudes = $manejadorSolicitudes->obtenerSolicitudes();


// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
} else {
    // Redirigir al usuario a la página de login si no hay datos de sesión
    header("location: ../pagina_html/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes</title>
    <!-- Incluir estilos de DataTables y Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Agregar iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.17.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">

</head>

<body>
    <div class="background"></div>
    <?php
    generarBarraNavegacion($usuario, $rol);
    ?>
    <br><br><br><br><br><br>

    <div class="row text-center text-white anton-regular">
        <h1>SOLICITUDES DE CITA | INMOBILIARIA JF</h1>
    </div>

    <br>

    <div class="text-center mb-3">
        <a href="create.php" class="btn btn-success me-2">Agregar Solicitud</a>
        <a href="../fpdf/reporte_solicitudes.php " target="_blank"  class="btn btn-secondary">
            <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
        </a>
    </div>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table id="solicitudes_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>ID Inmueble Interés</th>
                        <th>Opciones</th>
                        <th>Visualización</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($solicitudes)) {
                        foreach ($solicitudes as $solicitud) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($solicitud['idSolicitud']) . "</td>";
                            echo "<td>" . htmlspecialchars($solicitud['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($solicitud['Telefono']) . "</td>";
                            echo "<td>" . htmlspecialchars($solicitud['Correo']) . "</td>";
                            echo "<td>" . (isset($solicitud['idInmuebleInteres']) ? htmlspecialchars($solicitud['idInmuebleInteres']) : 'No especificado') . "</td>";
                            echo "<td style='text-align: center;'>";
                            echo "<div style='display: inline-block;'>";
                            echo "<a href='editar.php?id=" . urlencode($solicitud['idSolicitud']) . "' class='btn btn-primary me-1'><i class='bi bi-pencil-fill'></i></a>";
                            echo "<a href='#' onclick='confirmDeletion(" . htmlspecialchars($solicitud['idSolicitud']) . ")' class='btn btn-danger'><i class='bi bi-trash3'></i></a>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td class='text-center'>";
                            echo "<a href='../crudinmuebles/interfazinmuebles.php?id=" . urlencode($solicitud['idInmuebleInteres']) . "' class='btn btn-info' target='_blank'>Ver Inmueble</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 resultados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#solicitudes_table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
                    "lengthMenu": "Mostrar _MENU_ registros" // Texto personalizado para el menú de longitud
                },
                "pagingType": "simple_numbers", // Estilo de paginación
                "lengthMenu": [
                    [5, 10, 20, 50, -1], // Opciones del número de registros por página
                    [5, 10, 20, 50, "Todos"] // Etiquetas para las opciones
                ],
                "pageLength": 5 // Número de registros por página por defecto
            });
        });

        function confirmDeletion(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta solicitud?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>