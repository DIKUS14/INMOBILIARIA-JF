<?php
include 'conexion.php';

// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario y escapar caracteres especiales
    $nombres = mysqli_real_escape_string($con, $_POST['nombres']);
    $correo = mysqli_real_escape_string($con, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($con, $_POST['contrasena']);

    // Asegúrate de que el valor de 'rol' sea 'administrador' o 'usuario'
    $rol = ($_POST['rol'] === 'administrador') ? 'administrador' : 'usuario';

    // Generar un ID único y aleatorio de 6 caracteres
    $id = substr(bin2hex(random_bytes(3)), 0, 6);

    // Verificar si el ID ya existe
    $verificar_id = "SELECT * FROM TblUsuarios WHERE id = '$id'";
    $resultado = $con->query($verificar_id);

    while ($resultado->num_rows > 0) {
        // Si el ID ya existe, genera uno nuevo
        $id = substr(bin2hex(random_bytes(3)), 0, 6);
        $resultado = $con->query("SELECT * FROM TblUsuarios WHERE Id = '$id'");
    }

    // Encriptar la contraseña usando MD5
    $contrasena_md5 = md5($contrasena);

    // Consulta SQL para insertar el nuevo usuario con el ID generado
    $consulta = "INSERT INTO TblUsuarios (id, Nombres, Correo, Contraseña, rol) VALUES ('$id', '$nombres', '$correo', '$contrasena_md5', '$rol')";

    // Ejecutar la consulta
    if ($con->query($consulta)) {
        // Usuario registrado correctamente
        echo '<script>alert("Usuario registrado correctamente.");</script>';
    } else {
        // Error al registrar el usuario
        echo '<script>alert("Error al registrar el usuario: ' . $con->error . '");</script>';
    }
}

// Cerrar la conexión
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Usuarios</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../codigo_css/style2.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">
</head>
<body>
<div class="background"></div>
    <!-- Formulario para agregar un usuario -->
    <div class="container mt-5">
        <h2 class="mb-4">Crear Usuario</h2>
        <form action="" method="POST" onsubmit="return validarContraseña()">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="administrador">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar Usuario</button>
        </form>
        <br>
        <a class="btn btn-primary" href="../crudusuarios/index.php">Ir a la página principal</a>
    </div>
    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function validarContraseña() {
            var contraseña = document.getElementById('contrasena').value;
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (!regex.test(contraseña)) {
                alert("La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
