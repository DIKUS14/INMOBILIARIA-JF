<?php
// Incluir el archivo de conexión a la base de datos
include "../crudinmuebles/conexion.php"; // Asegúrate de tener un archivo con la conexión a la base de datos

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo y la nueva contraseña del formulario
    $correo = $_POST["correo"];
    $nueva_contrasena = md5($_POST["contrasena"]); // Aplicar la encriptación MD5 a la nueva contraseña

    // Consulta SQL para verificar si el correo existe en la base de datos
    $consulta = "SELECT id FROM tblusuarios WHERE Correo = '$correo'";
    $resultado = mysqli_query($con, $consulta); // Aquí se usa $con en lugar de $conexion

    // Verificar si se encontró algún resultado
    if (mysqli_num_rows($resultado) > 0) {
        // Actualizar la contraseña del usuario
        $fila = mysqli_fetch_assoc($resultado);
        $id_usuario = $fila["id"];

        // Consulta SQL para actualizar la contraseña
        $consulta_actualizar = "UPDATE tblusuarios SET Contraseña = '$nueva_contrasena' WHERE id = $id_usuario";
        if (mysqli_query($con, $consulta_actualizar)) { // Aquí también se usa $con en lugar de $conexion
            // Mostrar alerta
            echo "<script>alert('Contraseña actualizada correctamente.'); window.location.href = 'login.php';</script>";
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            echo "Error al actualizar la contraseña: " . mysqli_error($con); // Aquí también se usa $con en lugar de $conexion
        }
    } else {
        echo '<script>alert("El correo ingresado no está registrado en la base de datos."); window.location.href = "nueva_contraseña.php"</script>';
    } 

    // Cerrar la conexión a la base de datos
    mysqli_close($con); // Aquí también se usa $con en lugar de $conexion
}
?>
