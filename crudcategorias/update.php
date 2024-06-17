<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">
   
    
</head>
<body>

<div class="container">
<br><br><br><br><br>
    <div class="background"></div>
    <div class="container">
        <h2 class="mt-4 mb-4 text-center">Editar Categoría</h2>
        <?php
        // Incluye el archivo de conexión
        include '../crudinmuebles/conexion.php';

        // Definir variables para almacenar los valores actuales
        $idCategoria = '';
        $nombresCategoria = '';

        // Verificar si se ha proporcionado un ID para editar
        if (isset($_GET['id'])) {
            $idCategoria = mysqli_real_escape_string($con, $_GET['id']);

            // Consultar la base de datos para obtener los datos actuales de la categoría
            $consultaCategoria = "SELECT * FROM tblcategoria WHERE IdCategoria = '$idCategoria'";
            $resultadoCategoria = $con->query($consultaCategoria);

            if ($resultadoCategoria->num_rows == 1) {
                $filaCategoria = $resultadoCategoria->fetch_assoc();
                $nombresCategoria = $filaCategoria['Nombres'];
            } else {
                // El ID proporcionado no es válido
                echo '<div class="alert alert-danger" role="alert">La categoría no existe.</div>';
                exit();
            }
        }

        // Verifica si el formulario fue enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Escapa las entradas del formulario para evitar inyección SQL
            $nombres = $con->real_escape_string(trim($_POST['nombres']));

            // Inicializa variables para el mensaje
            $message = '';
            $messageType = '';

            // Verifica si el campo de nombre está vacío
            if (empty($nombres)) {
                $message = 'Por favor, complete el nombre de la categoría.';
                $messageType = 'warning';
            } else {
                // Actualiza los datos en la tabla
                $sql = "UPDATE tblcategoria SET Nombres = '$nombres' WHERE IdCategoria = '$idCategoria'";

                if ($con->query($sql) === TRUE) {
                    $message = 'Categoría actualizada correctamente.';
                    $messageType = 'success';
                } else {
                    $message = 'Error al actualizar la categoría: ' . $con->error;
                    $messageType = 'error';
                }
            }

            // Incluye el JavaScript para mostrar el mensaje SweetAlert
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: '$messageType',
                        title: 'Resultado',
                        text: '$message',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php';
                        }
                    });
                });
            </script>
            ";
        }

        // Cierra la conexión
        $con->close();
        ?>
        
        <form method="post">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo htmlspecialchars($nombresCategoria); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Volver</a>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($idCategoria); ?>">
        </form>
    </div>
</div>

<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.js"></script>

</body>
</html>