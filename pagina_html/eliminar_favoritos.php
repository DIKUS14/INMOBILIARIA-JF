<?php
include '../crudinmuebles/conexion.php';
session_start();

// Verificar si se recibió el ID del inmueble a eliminar
if (isset($_POST['idInmueble'])) {
    // Verificar si el usuario ha iniciado sesión
    if (isset($_SESSION['id_usuario'])) {
        $idUsuario = $_SESSION['id_usuario'];
        $idInmueble = $_POST['idInmueble'];

        // Consulta para eliminar el inmueble de la lista de favoritos del usuario actual
        $consulta_eliminar = "DELETE FROM favoritos WHERE idUsuario=? AND idInmueble=?";
        $sentencia_eliminar = mysqli_prepare($con, $consulta_eliminar);

        if ($sentencia_eliminar) {
            // Enlazar parámetros
            mysqli_stmt_bind_param($sentencia_eliminar, "ii", $idUsuario, $idInmueble);
            // Ejecutar la consulta
            mysqli_stmt_execute($sentencia_eliminar);
            // Verificar si se eliminó el inmueble correctamente
            if (mysqli_stmt_affected_rows($sentencia_eliminar) > 0) {
                echo "success"; // Indicar que la operación fue exitosa
            } else {
                echo "error"; // Indicar que hubo un problema al eliminar el inmueble
            }
            mysqli_stmt_close($sentencia_eliminar);
        } else {
            echo "error"; // Indicar que hubo un problema con la preparación de la consulta
        }
    } else {
        echo "error"; // Indicar que el usuario no ha iniciado sesión
    }

    mysqli_close($con); // Cerrar la conexión a la base de datos
} else {
    // Si no se recibió el ID del inmueble, mostrar un mensaje de error
    echo "error";
}
