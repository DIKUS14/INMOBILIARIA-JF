<?php
include 'conexion.php';

// Definir variables para almacenar los valores actuales
$idEditar = '';
$nombresEditar = '';
$correoEditar = '';
$rolEditar = '';

// Verificar si se ha proporcionado un ID para editar
if (isset($_GET['id'])) {
    $idEditar = mysqli_real_escape_string($con, $_GET['id']);

    // Consultar la base de datos para obtener los datos actuales del usuario
    $consultaEditar = "SELECT * FROM TblUsuarios WHERE Id = '$idEditar'";
    $resultadoEditar = $con->query($consultaEditar);

    if ($resultadoEditar->num_rows == 1) {
        $filaEditar = $resultadoEditar->fetch_assoc();
        $nombresEditar = $filaEditar['Nombres'];
        $correoEditar = $filaEditar['Correo'];
        $rolEditar = $filaEditar['rol'];  // Ajuste aquí, 'rol' en minúsculas
    } else {
        // El ID proporcionado no es válido
        echo '<div class="alert alert-danger" role="alert">El usuario no existe.</div>';
        exit();
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = mysqli_real_escape_string($con, $_POST['nombres']);
    $correo = mysqli_real_escape_string($con, $_POST['correo']);
    $contrasenaEditar = mysqli_real_escape_string($con, $_POST['contrasena']);
    $rol = ($_POST['rol'] === 'administrador') ? 'administrador' : 'usuario';

    // Verificar si se proporcionó una nueva contraseña
    if (!empty($contrasenaEditar)) {
        $contrasenaActualizar = ", Contraseña = '" . md5($contrasenaEditar) . "'";
    } else {
        $contrasenaActualizar = '';  // No actualizar la contraseña si está vacía
    }

    $consultaActualizar = "UPDATE TblUsuarios SET Nombres = '$nombres', Correo = '$correo'$contrasenaActualizar, rol = '$rol' WHERE Id = '$idEditar'";

    if ($con->query($consultaActualizar)) {
        echo 'success';
    } else {
        echo 'error';
    }

    exit(); // Terminar el script después de procesar la solicitud
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
     <!-- Custom CSS -->
     <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">
</head>
<body>
<div class="background"></div>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Usuario</h2>
        <form id="userForm" method="POST">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $nombresEditar; ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correoEditar; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="administrador" <?php echo ($rolEditar === 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="usuario" <?php echo ($rolEditar === 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar Usuario</button>
            <a class="btn btn-primary" href="../crudusuarios/index.php">Ir a la página principal</a>
        </form>
    </div>
    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-hHEpDxF3LOsw5i6Tu6v6xKc3z+EQ8vOYbMcRMbSLt+qdZp7A05M54AvvVRyBkEBO" crossorigin="anonymous"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script>
        // Validación de formulario con SweetAlert2
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir envío directo del formulario

            // Validar contraseña antes de enviar
            if (!validarContraseña()) {
                return;
            }

            // Realizar la petición AJAX para actualizar el usuario
            var formData = new FormData(this);
            fetch(this.action, {
                method: this.method,
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Mostrar SweetAlert según la respuesta del servidor
                if (data === 'success') {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Usuario actualizado correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = '../crudusuarios/index.php';
                    });
                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Error al actualizar el usuario.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function validarContraseña() {
            var contraseña = document.getElementById('contrasena').value;
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (contraseña.trim() !== '' && !regex.test(contraseña)) {
                Swal.fire({
                    title: 'Error de validación',
                    text: 'La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
