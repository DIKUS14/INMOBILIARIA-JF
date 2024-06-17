
<?php
require_once('conne.php'); // Incluir el archivo que contiene la clase de conexión

class ManejadorSolicitudes
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion; // Recibes la instancia de la conexión en el constructor
    }

    // Método para insertar una solicitud en la base de datos
    public function insertarSolicitud($nombreCompleto, $telefono, $correoElectronico, $idInmueble)
    {
        // Escapar los datos para evitar inyección SQL
        $nombreCompleto = $this->conexion->real_escape_string($nombreCompleto);
        $telefono = $this->conexion->real_escape_string($telefono);
        $correoElectronico = $this->conexion->real_escape_string($correoElectronico);

        // Preparar la consulta SQL
        $sql = "INSERT INTO solicitudes (Nombre, Telefono, Correo, idInmuebleInteres) VALUES ('$nombreCompleto', '$telefono', '$correoElectronico', '$idInmueble')";

        // Ejecutar la consulta
        if ($this->conexion->query($sql)) {
            return true; // Retorna verdadero si la inserción fue exitosa
        } else {
            return false; // Retorna falso si hubo un error en la inserción
        }
    }
}

// Crear una instancia de la conexión
$conexion = new Conexion();
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreCompleto = $_POST['nombreCompleto'];
    $telefono = $_POST['telefono'];
    $correoElectronico = $_POST['correoElectronico'];
    $idInmueble = $_POST['idInmueble']; // Obtener el ID del inmueble desde el formulario

    // Crear una instancia del manejador de solicitudes, pasando la conexión como parámetro
    $manejadorSolicitudes = new ManejadorSolicitudes($conexion->con);


    // Insertar la solicitud en la base de datos y verificar si fue exitosa
    if ($manejadorSolicitudes->insertarSolicitud($nombreCompleto, $telefono, $correoElectronico, $idInmueble)) {
        echo '<script>alert("Solicitud enviada correctamente."); window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>'; // Muestra el mensaje de éxito y redirige
    } else {
        echo "Error al guardar los datos en la base de datos.";
    }
}



?>