<?php
include 'conexion.php';

// Verificar si se ha enviado la petición de eliminación por GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Asegurarse de que $idUsuario es un valor válido (puedes agregar más validaciones si es necesario)
    if (!is_numeric($idUsuario)) {
        echo "ID de usuario no válido.";
        exit;
    }

    // Consulta SQL para eliminar el usuario por su ID
    $eliminar = "DELETE FROM TblUsuarios WHERE Id = $idUsuario";

    // Ejecutar la consulta
    if (mysqli_query($con, $eliminar)) {
        // Mostrar un mensaje de confirmación de eliminación
        echo '<script>alert("El usuario ha sido eliminado correctamente.");</script>';
    } else {
        // Manejar errores durante la eliminación
        echo "Error al eliminar el usuario: " . mysqli_error($con);
    }
}

// Redirigir de vuelta a la página principal
header("Location: index.php");
exit;
