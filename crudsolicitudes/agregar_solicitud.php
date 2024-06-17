<!-- <?php
// Incluir el archivo de conexión a la base de datos
require_once 'conne.php';
// Crear una instancia de la conexión
$conexion = new Conexion();
// Verificar si se ha enviado la petición de agregar solicitud por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Consulta SQL para insertar la nueva solicitud en la base de datos
    $insertar = "INSERT INTO solicitudes (Nombre, Telefono, Correo) VALUES ('$nombre', '$telefono', '$correo')";

    // Ejecutar la consulta para insertar la solicitud
    if (mysqli_query($conexion->con, $insertar)) {
        // Redireccionar de vuelta a la página principal con un mensaje de éxito
        header("Location: index.php?mensaje=La solicitud se agregó correctamente.");
        exit;
    } else {
        // Manejar errores durante la inserción
        echo "Error al agregar la solicitud: " . mysqli_error($conexion->con);
    }
} else {
    // Si no se recibió una solicitud POST válida, redireccionar a la página principal
    header("Location: index.php");
    exit;
}
?> -->
