<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$conexion = mysqli_connect("localhost", "root", "", "realstate");

if (!$conexion) {
    echo "Error de conexión a la base de datos";
    exit;
}

if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $cedula = $_POST['usuario']; // Usamos 'usuario' del formulario para pasar la cédula
    $contraseña = md5($_POST['contraseña']); // Encriptamos la contraseña usando MD5

    $consulta = "SELECT * FROM tblusuarios WHERE Nombres=? AND Contraseña=?";
    $sentencia = mysqli_prepare($conexion, $consulta);

    if (!$sentencia) {
        die("Error en la consulta preparada: " . mysqli_error($conexion));
    }

    mysqli_stmt_bind_param($sentencia, "ss", $cedula, $contraseña);
    mysqli_stmt_execute($sentencia);
    $resultado = mysqli_stmt_get_result($sentencia);
    $filas = mysqli_fetch_assoc($resultado);

    if ($filas) {
        $_SESSION['usuario'] = $filas['Nombres']; // Guardamos el nombre en la sesión
        $_SESSION['id_usuario'] = $filas['id'];
        $_SESSION['rol'] = $filas['rol'];

        if ($_SESSION['rol'] == "administrador") {
            header("location: ../pagina_html/entrar_admin.php"); // Redirige a la página de administrador
        } else {
            header("location: ../pagina_html/entrar_usuario.php"); // Redirige a la página de usuario normal
        }
        exit();
    } else {
        echo '<script>alert("Contraseña incorrecta."); window.location.href = "login.php";</script>';
        exit();
    }

    mysqli_stmt_close($sentencia);
    mysqli_close($conexion);
} elseif (isset($_POST['accion']) && $_POST['accion'] == 'registro') {
    // Proceso de registro
}
