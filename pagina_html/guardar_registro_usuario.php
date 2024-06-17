<?php
include 'conexion.php';

// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombres = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contraseña'];

    // Encriptar la contraseña utilizando MD5
    $contrasena_encriptada = md5($contrasena);

    // Generar un ID único y aleatorio de 6 caracteres
    $id = substr(bin2hex(random_bytes(3)), 0, 6);

    // Verificar si el ID ya existe
    $verificar_id = "SELECT * FROM TblUsuarios WHERE id = '$id'";
    $resultado = $con->query($verificar_id);

    while ($resultado->num_rows > 0) {
        // Si el ID ya existe, genera uno nuevo
        $id = substr(bin2hex(random_bytes(3)), 0, 6);
        $resultado = $con->query("SELECT * FROM TblUsuarios WHERE id = '$id'");
    }

    // Consulta SQL para insertar el nuevo usuario con el ID generado
    $consulta = "INSERT INTO TblUsuarios (id, Nombres, Correo, Contraseña, rol) VALUES ('$id', '$nombres', '$correo', '$contrasena_encriptada', 'usuario')";

    // Ejecutar la consulta
    if ($con->query($consulta)) {
        // Usuario registrado correctamente
        echo '<script>alert("Se ha registrado correctamente."); window.location.href = "login.php"</script>';
    } else {
        // Error al registrar el usuario
        echo '<script>alert("Error al registrarse.");</script>';
    }
}

// Cerrar la conexión
$con->close();
