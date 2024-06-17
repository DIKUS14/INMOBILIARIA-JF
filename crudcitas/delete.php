<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado la petición de eliminación por POST y si se recibió el ID de la cita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cita'])) {
    // Obtener el ID de la cita desde el formulario POST
    $idCita = $_POST['id_cita'];

    // Asegurarse de que $idCita sea un valor numérico válido
    if (!is_numeric($idCita)) {
        echo "ID de cita no válido.";
        exit;
    }

    // Consulta SQL para eliminar la cita por su ID
    $sql_eliminar_cita = "DELETE FROM TBLCita WHERE IdCita = $idCita";

    // Ejecutar la consulta para eliminar la cita
    if (mysqli_query($con, $sql_eliminar_cita)) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito y redirigir a index.php
        echo '<script>alert("La cita ha sido eliminada correctamente.");</script>';
        header("Location: index.php");
        exit;
    } else {
        // Si hay un error durante la eliminación, mostrar el mensaje de error
        echo "Error al eliminar la cita: " . mysqli_error($con);
    }
} else {
    // Si no se recibió un ID de cita válido, redirigir a index.php
    header("Location: index.php");
    exit;
}
