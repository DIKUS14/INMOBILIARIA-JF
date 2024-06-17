<?php
// Definición de los datos de conexión
$servername = "localhost";  // Dirección del servidor de la base de datos
$database = "realstate";     // Nombre de la base de datos
$username = "root";          // Nombre de usuario de la base de datos
$pasaword = "";              // Contraseña de la base de datos (en este caso, vacía)

// Creación de la conexión utilizando los datos definidos anteriormente
$con =  new mysqli("$servername", "$username", "$pasaword", "$database");

// Verificación de la conexión
if ($con->connect_error) {
    // En caso de error, se muestra un mensaje indicando la falla y se detiene la ejecución
    die("FALLA EN LA CONEXION " . $con->connect_error);
}
