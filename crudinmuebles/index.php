<?php
session_start();
include 'conexion.php';
include '../pagina_html/funciones.php';

// Verificar si se ha enviado la petición de eliminación por AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_inmueble'])) {
    $idInmueble = $_POST['id_inmueble'];
    $sql = "DELETE FROM TBLInmueble WHERE IdInmueble = $idInmueble";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
        exit;
    }
}

// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
} else {
    header("location: ../pagina_html/login.php");
    exit();
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Sin rol';

// Contar el número de registros en la tabla TBLInmueble
$consulta_contar = "SELECT COUNT(*) AS total FROM TBLInmueble";
$resultado_contar = mysqli_query($con, $consulta_contar);
$fila_contar = mysqli_fetch_assoc($resultado_contar);
$total_registros = $fila_contar['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Inmuebles</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mina&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <!-- Logo en forma de icono en pestaña-->
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">
</head>

<body>
    <div class="background"></div>
    <?php
    // Llama a la función para generar la barra de navegación
    generarBarraNavegacion($usuario, $rol);
    ?>
    <br><br><br><br><br>

    <div class="row text-center text-white anton-regular">
        <h1>REGISTRO DE INMUEBLES | INMOBILIARIA JF</h1>
    </div>
    <br>
    <div class="text-center mb-3">
        <a href="create.php" class="btn btn-success me-2">Agregar Solicitud</a>
        <button id="export-excel" class="btn btn-primary">
            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
        </button>


    </div>

    </div>
    <br>
    <div class="container-fluid of">

        <div class="table-responsive">
            <table id="inmuebles_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID Inmueble</th>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Imágenes</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th>Localidad</th>
                        <th>Dirección</th>
                        <th>Estrato</th>
                        <th>Área Construida</th>
                        <th>Número de Pisos</th>
                        <th>Habitaciones</th>
                        <th>Baños</th>
                        <th>Cocina</th>
                        <th>Garaje</th>
                        <th>Patio</th>
                        <th>Estudio</th>
                        <th>Contacto</th>
                        <th>Categoría</th>
                        <th>Opciones</th>
                        <th>Visualización</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'conexion.php';

                    $consulta = "SELECT TBLInmueble.IdInmueble, TBLInmueble.Titulo, TBLInmueble.Estado, TBLInmueble.Precio, TBLInmueble.Localidad, TBLInmueble.Dirección, TBLInmueble.Estrato, TBLInmueble.Area_construida, TBLInmueble.NumeroPisos, TBLInmueble.Habitaciones, TBLInmueble.Baños, TBLInmueble.Cocina, TBLInmueble.Garaje, TBLInmueble.Patio, TBLInmueble.Estudio, TBLInmueble.Contacto, TBLCategoria.Nombres 
                FROM TBLInmueble 
                INNER JOIN TBLCategoria ON TBLInmueble.codigoc = TBLCategoria.IdCategoria";

                    $registro = mysqli_query($con, $consulta) or die("Problemas en el select:" . mysqli_error($con));

                    while ($reg = mysqli_fetch_array($registro)) : ?>
                        <tr>
                            <td><?= $reg['IdInmueble'] ?></td>
                            <td><?= $reg['Titulo'] ?></td>
                            <td class="<?= $reg['Estado'] == 'Disponible' ? 'text-success' : ($reg['Estado'] == 'En proceso de adquisición' ? 'text-warning' : 'text-danger') ?>"><?= $reg['Estado'] ?></td>
                            <td>
                                <?php
                                $idInmueble = $reg['IdInmueble'];
                                $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
                                $resultado_imagen = mysqli_query($con, $consulta_imagen);
                                $row_imagen = mysqli_fetch_assoc($resultado_imagen);
                                $ruta_imagen = $row_imagen['RutaImagen'];
                                echo $ruta_imagen ? '<img src="' . $ruta_imagen . '" alt="Miniatura" style="max-width: 100px; max-height: 100px;">' : 'No hay imagen';
                                ?>
                            </td>
                            <td>
                                <?php
                                $consulta_ubicacion = "SELECT Ubicacion FROM TBLInmueble WHERE IdInmueble = $idInmueble";
                                $resultado_ubicacion = mysqli_query($con, $consulta_ubicacion);
                                $row_ubicacion = mysqli_fetch_assoc($resultado_ubicacion);
                                $ruta_ubicacion = $row_ubicacion['Ubicacion'];
                                echo $ruta_ubicacion ? '<img src="' . $ruta_ubicacion . '" alt="Imagen de Ubicación" style="max-width: 100px; max-height: 100px;">' : 'No hay imagen';
                                ?>
                            </td>
                            <td><?= '$' . $reg['Precio'] ?></td>
                            <td><?= $reg['Localidad'] ?></td>
                            <td><?= $reg['Dirección'] ?></td>
                            <td><?= $reg['Estrato'] ?></td>
                            <td><?= $reg['Area_construida'] . 'm²' ?></td>
                            <td><?= $reg['NumeroPisos'] ?></td>
                            <td><?= $reg['Habitaciones'] ?></td>
                            <td><?= $reg['Baños'] ?></td>
                            <td><?= $reg['Cocina'] ?></td>
                            <td><?= $reg['Garaje'] ?></td>
                            <td><?= $reg['Patio'] ?></td>
                            <td><?= $reg['Estudio'] ?></td>
                            <td><?= $reg['Contacto'] ?></td>
                            <td><?= $reg['Nombres'] ?></td>
                            <td>
                                <a href="update.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                <form method="post" action="delete.php" style="display:inline;">
                                    <input type="hidden" name="id_inmueble" value="<?= $reg['IdInmueble'] ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este inmueble?');"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                            <td>
                                <a href="interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-info">Ver Inmueble</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>
    <br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#inmuebles_table').DataTable({
                "scrollX": true, // Habilitar desplazamiento horizontal
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
    </script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script>
    document.getElementById('export-excel').addEventListener('click', function() {
        try {
            var sheet = XLSX.utils.table_to_sheet(document.getElementById('inmuebles_table'));

            // Verificar la estructura de sheet con console.log
            console.log(sheet);

            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, sheet, 'Inmuebles');

            // Descargar el archivo Excel
            XLSX.writeFile(workbook, 'inmuebles.xlsx');
        } catch (error) {
            console.error('Error al exportar a Excel:', error.message);
        }
    });
</script>



</body>

</html>