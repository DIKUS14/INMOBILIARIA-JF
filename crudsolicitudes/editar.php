<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conne.php';
// Crear una instancia de la conexión
$conexion = new Conexion();
// Verificar si se ha enviado la petición de edición por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_solicitud'])) {
    // Obtener los datos del formulario
    $idSolicitud = $_POST['id_solicitud'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Consulta SQL para actualizar la solicitud en la base de datos
    $actualizar = "UPDATE solicitudes SET Nombre = '$nombre', Telefono = '$telefono', Correo = '$correo' WHERE idSolicitud = $idSolicitud";

    // Ejecutar la consulta para actualizar la solicitud
    if (mysqli_query($conexion->con, $actualizar)) {
        // Redireccionar de vuelta a la página principal con un mensaje de éxito
        header("Location: index.php?mensaje=La solicitud se actualizó correctamente.");
        exit;
    } else {
        // Manejar errores durante la actualización
        echo "Error al actualizar la solicitud: " . mysqli_error($conexion->con);
    }
} else {
    // Obtener el ID de la solicitud de la URL
    if (isset($_GET['id'])) {
        $idSolicitud = $_GET['id'];

        // Consulta SQL para obtener los datos de la solicitud a editar
        $consulta = "SELECT * FROM solicitudes WHERE idSolicitud = $idSolicitud";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion->con, $consulta);

        // Verificar si se encontró la solicitud
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Obtener los datos de la solicitud
            $solicitud = mysqli_fetch_assoc($resultado);
            $nombre = $solicitud['Nombre'];
            $telefono = $solicitud['Telefono'];
            $correo = $solicitud['Correo'];
        } else {
            // Si no se encuentra la solicitud, redireccionar a la página principal
            header("Location: index.php");
            exit;
        }
    } else {
        // Si no se recibió un ID válido por GET, redireccionar a la página principal
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">
</head>

<body>
<div class="background"></div>
    <div class="container mt-5">
        <h2>Editar Solicitud</h2>
        <form action="" method="POST">
            <input type="hidden" name="id_solicitud" value="<?php echo $idSolicitud; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <!-- Cambiar el botón de tipo "button" a un enlace "a" -->
        <a class="btn btn-secondary" href="../crudsolicitudes/index.php">Ir a la página principal</a>
        </form>
    </div>
</body>

</html>