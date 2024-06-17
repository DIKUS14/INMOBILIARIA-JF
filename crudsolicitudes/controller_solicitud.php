
<?php
class ManejadorSolicitudes
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Método para obtener todas las solicitudes de la base de datos
    public function obtenerSolicitudes()
    {
        $solicitudes = array();

        // Realizar la consulta SQL para obtener todas las solicitudes
        $consulta = "SELECT * FROM solicitudes";
        $resultado = $this->conexion->query($consulta);

        // Verificar si hay resultados
        if ($resultado && $resultado->num_rows > 0) {
            // Iterar sobre los resultados y almacenarlos en un array
            while ($fila = $resultado->fetch_assoc()) {
                $solicitudes[] = $fila;
            }
        }

        // Devolver el array de solicitudes
        return $solicitudes;
    }
}



session_start();
// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
} else {
    // Redirigir al usuario a la página de login si no hay datos de sesión
    header("location: login.php");
    exit();
}
// Asegúrate de verificar si estas claves existen para evitar errores
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Sin rol';
// Crear una instancia de la conexión
$conexion = new Conexion();

// Crear una instancia del manejador de solicitudes
$manejadorSolicitudes = new ManejadorSolicitudes($conexion->con);

// Obtener todas las solicitudes
$solicitudes = $manejadorSolicitudes->obtenerSolicitudes();
?>

<?php
class EliminarSolicitud
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Método para eliminar una solicitud por su ID
    public function eliminarSolicitud($idSolicitud)
    {
        // Asegúrate de que $idSolicitud es un valor válido (puedes agregar más validaciones si es necesario)
        if (!is_numeric($idSolicitud)) {
            echo "ID de solicitud no válido.";
            return false;
        }

        // Preparar la consulta SQL para eliminar la solicitud
        $consulta = "DELETE FROM solicitudes WHERE idSolicitud = ?";
        $sentencia = $this->conexion->prepare($consulta);

        // Vincular el parámetro de ID de solicitud
        $sentencia->bind_param("i", $idSolicitud);

        // Ejecutar la consulta
        if ($sentencia->execute()) {
            // Si la consulta se ejecuta correctamente, muestra un mensaje de éxito
            return true;
        } else {
            // Si hay algún error, muestra un mensaje de error
            return false;
        }
    }
}
?>

<?php
class EditarSolicitud
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Método para editar una solicitud
    public function editarSolicitud($idSolicitud, $nombre, $telefono, $correo)
    {
        // Asegurarse de que $idSolicitud es un valor válido
        if (!is_numeric($idSolicitud)) {
            echo "ID de solicitud no válido.";
            return false;
        }

        // Preparar la consulta SQL para actualizar la solicitud
        $consulta = "UPDATE solicitudes SET Nombre = ?, Telefono = ?, Correo = ? WHERE idSolicitud = ?";
        $sentencia = $this->conexion->prepare($consulta);

        // Vincular los parámetros de la consulta
        $sentencia->bind_param("sssi", $nombre, $telefono, $correo, $idSolicitud);

        // Ejecutar la consulta
        if ($sentencia->execute()) {
            // Si la consulta se ejecuta correctamente, devuelve true
            return true;
        } else {
            // Si hay algún error, devuelve false
            return false;
        }
    }
}
?>