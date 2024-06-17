<?php
// Incluir el archivo de conexión a la base de datos
include '../crudinmuebles/conexion.php';

// Verificar si se ha enviado la petición de eliminación por GET y si se recibió el ID de la categoría
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Obtener el ID de la categoría desde la URL
    $idCategoria = $_GET['id'];

    // Asegurarse de que $idCategoria sea un valor numérico válido
    if (!is_numeric($idCategoria)) {
        echo "ID de categoría no válido.";
        exit;
    }

    // Consulta SQL para eliminar la categoría por su ID
    $sql_eliminar_categoria = "DELETE FROM tblcategoria WHERE IdCategoria = $idCategoria";

    // Ejecutar la consulta para eliminar la categoría
    if ($con->query($sql_eliminar_categoria) === TRUE) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito y redirigir a index.php
        echo '<script>
                alert("La categoría ha sido eliminada correctamente.");
                window.location.href = "index.php";
              </script>';
        exit;
    } else {
        // Si hay un error durante la eliminación, mostrar el mensaje de error
        echo "Error al eliminar la categoría: " . $con->error;
    }
} else {
    // Si no se recibió un ID de categoría válido, redirigir a index.php
    header("Location: index.php");
    exit;
}

// Cerrar la conexión
$con->close();
?>
