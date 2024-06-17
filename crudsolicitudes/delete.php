<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conne.php';

// Crear una instancia de la conexión
$conexion = new Conexion();

// Verificar si se ha enviado la petición de eliminación por GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idSolicitud = $_GET['id'];

    // Asegúrate de que $idSolicitud es un valor válido (puedes agregar más validaciones si es necesario)
    if (!is_numeric($idSolicitud)) {
        echo "ID de solicitud no válido.";
        exit;
    }

    // Consulta SQL para eliminar la solicitud por su ID
    $eliminar = "DELETE FROM solicitudes WHERE idSolicitud = $idSolicitud";

    // Ejecutar la consulta para eliminar la solicitud
    if (mysqli_query($conexion->con, $eliminar)) {
        // Muestra un mensaje de éxito utilizando JavaScript
        echo '<script>alert("La solicitud ha sido eliminada correctamente.");</script>';
    } else {
        // Manejar errores durante la eliminación
        echo "Error al eliminar la solicitud: " . mysqli_error($conexion->con);
    }
}

// Redirigir de vuelta a la página principal
header("Location: index.php");
exit;
