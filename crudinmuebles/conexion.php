<?php
// Parámetros de conexión a la base de datos
$servername = "localhost";  // Nombre del servidor de la base de datos, generalmente 'localhost' en entornos locales
$database = "realstate";    // Nombre de la base de datos a la que se conectará
$username = "root";         // Nombre de usuario para la base de datos
$password = "";             // Contraseña del usuario para la base de datos (vacía para muchos entornos locales)

// Crear una conexión a la base de datos
$con = new mysqli($servername, $username, $password, $database);  // Se crea un nuevo objeto mysqli para la conexión

// Verificar si la conexión se estableció correctamente
if ($con->connect_error) {  // Si hay un error en la conexión, se ejecuta el bloque siguiente
    die("FALLA EN LA CONEXION " . $con->connect_error);  // Termina el script y muestra un mensaje de error
}
?>
