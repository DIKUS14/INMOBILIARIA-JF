
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "realstate");
// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error();
    exit();
}
// ver si el usuario está en la sesión
if (!isset($_SESSION['usuario'])) {
    echo "Usuario no autenticado.";
    exit();
}
$idUsuario = $_SESSION['id_usuario']; // $_SESSION['id_usuario'] asi es como se captura el id del usuario
// Obtener los datos enviados por la solicitud AJAX
$idInmueble = $_POST['idInmueble'];
$isFavorite = $_POST['isFavorite'];

// Si se marca como favorito, insertar en la tabla de favoritos; de lo contrario, eliminar la entrada de la tabla
if ($isFavorite) {
    // Insertar la tarjeta marcada como favorita en la tabla de favoritos
    $insert_query = "INSERT INTO favoritos (idUsuario, idInmueble) VALUES ('$idUsuario', '$idInmueble')";
    if (!mysqli_query($con, $insert_query)) {
        die("Error al insertar en la tabla de favoritos: " . mysqli_error($con));
    }
} else {
    // Eliminar la tarjeta de la tabla de favoritos
    $delete_query = "DELETE FROM favoritos WHERE idUsuario = '$idUsuario' AND idInmueble = '$idInmueble'";
    if (!mysqli_query($con, $delete_query)) {
        die("Error al eliminar de la tabla de favoritos: " . mysqli_error($con));
    }
}
// Cerrar la conexión a la base de datos
mysqli_close($con);

echo "La información de la tarjeta se ha guardado correctamente en la tabla de favoritos.";
?>