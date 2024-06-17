<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de categorías</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">


<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
</head>
<body>
    <br><br><br><br><br>
    <div class="background"></div>
    <div class="container">
        <h2 class="mt-4 mb-4 text-center">Registros de la tabla Categoría</h2>

        <div class="text-center mb-3">
            <a href="create.php" class="btn btn-success">Agregar Registro</a>
        </div>
        <div class="text-center mb-3">
            <a href="../crudinmuebles/create.php" class="btn btn-secondary">Regresar</a>
        </div>

        <?php
        // Incluir el archivo de conexión
        include '../crudinmuebles/conexion.php';

        // Consulta SQL para seleccionar todos los registros de la tabla tblcategoria
        $sql = "SELECT * FROM tblcategoria";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los resultados en una tabla utilizando Bootstrap para estilos
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped table-bordered table-sm table-spacing">';
            echo '<thead class="table-dark"><tr><th class="text-center">IdCategoria</th><th class="text-center">Nombres</th><th class="text-center">Acciones</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td class="text-center">' . $row['IdCategoria'] . '</td>';
                echo '<td class="text-center">' . $row['Nombres'] . '</td>';
                echo '<td class="text-center">';
                echo '<a href="update.php?id=' . $row['IdCategoria'] . '" class="btn btn-primary btn-action btn-action-edit me-2" title="Editar"><i class="bi bi-pencil"></i></a>';
                echo '<button class="btn btn-danger btn-action btn-action-delete" onclick="confirmDelete(' . $row['IdCategoria'] . ')" title="Eliminar"><i class="bi bi-trash"></i></button>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '</div>'; // Cierre de div.table-responsive
        } else {
            echo "<p class='alert alert-warning'>No se encontraron registros.</p>";
        }

        // Cerrar la conexión
        $con->close();
        ?>

    </div>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.js"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                icon: 'warning',
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará la categoría permanentemente.',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redireccionar al archivo delete.php con el id de la categoría a eliminar
                    window.location.href = 'delete.php?id=' + id;
                }
            });
        }
    </script>

</body>
</html>
