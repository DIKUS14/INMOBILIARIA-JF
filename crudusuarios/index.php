<?php
session_start();
include 'conexion.php';
include '../pagina_html/funciones.php';

// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
} else {
    // Redirigir al usuario a la página de login si no hay datos de sesión
    header("location: ../pagina_html/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <!-- Incluir estilos de DataTables y Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Agregar iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.17.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">

</head>

<body>
    <div class="background"></div>
    <?php
    // Llama a la función para generar la barra de navegación
    generarBarraNavegacion($usuario, $rol);
    ?>

    <br><br><br><br><br><br>
    <!-- Título de la página -->

    <div class="row text-center text-white anton-regular ">
        <h1>REGISTRO DE USUARIOS | INMOBILIARIA JF</h1>

    </div>
    <br>
    <div class="text-center mb-3">
        <a href="create.php" class="btn btn-success me-2">Agregar Registro</a>
        <a href="../fpdf/generate_pdf.php" class="btn btn-secondary">
            <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
        </a>
    </div>
  
    <div class="container mt-5">

      
        
        <div class="table-responsive">
            <table id="usuarios_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Correo Electrónico</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consultar los datos de la tabla tblusuarios
                    $consulta = "SELECT * FROM tblusuarios";
                    $resultado = $con->query($consulta);

                    // Mostrar los datos en la tabla
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila['id'] . "</td>";
                            echo "<td>" . $fila['Nombres'] . "</td>";
                            echo "<td>" . $fila['Correo'] . "</td>";
                            echo "<td>" . $fila['Contraseña'] . "</td>"; // Nueva columna para mostrar la contraseña
                            echo "<td>" . $fila['rol'] . "</td>";
                            echo "<td style='text-align: center;'>";
                            echo "<div style='display: inline-block;'>";
                            echo "<a href='editar.php?id=" . $fila['id'] . "' class='btn btn-primary me-1'><i class='bi bi-pencil-fill'></i></a>";
                            echo "<a href='#' onclick='confirmDeletion(" . $fila['id'] . ")' class='btn btn-danger'><i class='bi bi-trash3'></i></a>";
                            echo "</div>";
                            echo "</td>";


                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>0 resultados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#usuarios_table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
                    "lengthMenu": "Mostrar _MENU_ registros" // Texto personalizado para el menú de longitud
                },
                "pagingType": "simple_numbers", // Estilo de paginación
                "lengthMenu": [
                    [5, 10, 20, 50, -1], // Opciones del número de registros por página
                    [5, 10, 20, 50, "Todos"] // Etiquetas para las opciones
                ],
                "pageLength": 5 // Número de registros por página por defecto

            });
        });

        function confirmDeletion(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>