<?php
session_start(); // Inicia la sesión
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos
include '../pagina_html/funciones.php'; // Incluye el archivo de funciones

// Consulta SQL para obtener todos los usuarios
$consulta = "SELECT * FROM tblusuarios";
$resultado = $con->query($consulta);

// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario']; // Asigna el valor de 'usuario' de la sesión a la variable $usuario
    $rol = $_SESSION['rol']; // Asigna el valor de 'rol' de la sesión a la variable $rol
} else {
    // Redirigir al usuario a la página de login si no hay datos de sesión
    header("location: ../pagina_html/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de citas</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
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
    ?><br><br><br><br><br>
    <!-- Título de la página -->
    <br>
    <div class="row text-center text-white anton-regular">
        <h1>REGISTRO DE CITAS | INMOBILIARIA JF</h1>
    </div>
    <br>
    <div class="text-center mb-3">
        <a href="create.php" class="btn btn-success me-2">Agregar Solicitud</a>
        <a href="../fpdf/reporte_citas.php" class="btn btn-secondary">
            <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
        </a>
    </div>
    <br>
    <div class="container">

        <div class="table-responsive">
            <table id="citas_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Usuario</th>
                        <th>Nombre de Asesor</th>
                        <th>Dirección</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Teléfono</th>
                        <th>Código</th>
                        <th>Información del Inmueble</th>
                        <th>Precio Final</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // Conectar a la base de datos
                    $conexion = new mysqli("localhost", "root", "", "realstate");

                    // Verificar la conexión
                    if ($conexion->connect_error) {
                        die("Error de conexión: " . $conexion->connect_error);
                    }

                    // Consultar los datos de la tabla tblcita
                    $consulta = "SELECT * FROM tblcita";
                    $resultado = $conexion->query($consulta);

                    // Mostrar los datos en la tabla
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila['IdCita'] . "</td>";
                            echo "<td>" . $fila['Nombre_usuario'] . "</td>";
                            echo "<td>" . $fila['Nombre_asesor'] . "</td>";
                            echo "<td>" . $fila['Dirección'] . "</td>";
                            echo "<td>" . $fila['Fecha'] . "</td>";
                            echo "<td>" . $fila['Hora'] . "</td>";
                            echo "<td>" . $fila['Telefono'] . "</td>";
                            echo "<td>" . $fila['codigoc'] . "</td>";
                            echo "<td>" . $fila['infoinmueble'] . "</td>";
                            echo "<td>" . $fila['Precio_final'] . "</td>";
                            echo "<td>";
                            // Botones de editar y eliminar con confirmación
                            echo "<a href='editar.php?id=" . $fila['IdCita'] . "' class='btn btn-primary me-1'><i class='bi bi-pencil-fill'></i></a>";
                            echo "<form method='post' action='delete.php' style='display: inline;'>";
                            echo "<input type='hidden' name='id_cita' value='" . $fila['IdCita'] . "'>";
                            echo "<button type='submit' class='btn btn-danger' onclick='return confirmDeletion();'><i class='bi bi-trash3'></i></button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>0 resultados</td></tr>";
                    }

                    // Cerrar la conexión
                    $conexion->close();
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
            $('#citas_table').DataTable({
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



        function confirmDeletion() {
            return confirm('¿Estás seguro de que deseas eliminar esta cita?');
        }
    </script>

</body>

</html>