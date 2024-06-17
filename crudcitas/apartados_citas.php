<?php
include 'conexion.php'; // Incluir el archivo de conexión

session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("location: login.php");
    exit();
}

$idUsuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOBILIARIA JF - MIS CITAS</title>
    <link rel="stylesheet" type="text/css" href="../codigo_css/pag.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Google Fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">


</head>

<body>
    <header>
        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">
                    <span style="font-size: 25px;  margin-left: 1px;">
                        <?php echo "Bienvenido, " . $usuario; ?>

                        <span style="color: black; font-size: 15px; margin-left: 10px;">
                            <?php echo " (" . $rol . ")"; ?>
                        </span>

                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
    </header>
    <!-- Fin de la barra de navegacion -->

    <body>
        <!-- Título de la página -->
        <div class="container">
            <!-- Título de la página -->
            <div class="row text-center">
                <h1>REGISTRO DE MIS CITAS | INMOBILIARIA JF</h1>
            </div>
            <br><br>
            <!-- Tabla para mostrar los registros -->
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>ASESOR</th>
                        <th>DIRECCIÓN</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>TELÉFONO</th>
                        <th>CATEGORÍA</th>
                        <th>INMUEBLE</th>
                        <th>PRECIO INICIAL</th>
                        <th>PRECIO FINAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta de los datos 
                    $consulta = "SELECT tblcita.Nombre_usuario, tblcita.Dirección, tblcita.Fecha, tblcita.Telefono, 
TBLCategoria.Nombres, TBLInmueble.IdInmueble, TBLInmueble.Precio, 
tblcita.Nombre_asesor, tblcita.Hora, tblcita.Precio_final
FROM tblcita 
INNER JOIN TBLCategoria ON tblcita.codigoc = TBLCategoria.IdCategoria
INNER JOIN TBLInmueble ON tblcita.infoinmueble = TBLInmueble.IdInmueble
INNER JOIN tblusuarios ON tblcita.IdUsuario = tblusuarios.id
WHERE tblusuarios.id = '$idUsuario'";
                    // Ejecutar la consulta
                    $registro = mysqli_query($con, $consulta) or die("Problemas en el select:" . mysqli_error($con));
                    // Iterar sobre los resultados de la consulta
                    while ($reg = mysqli_fetch_array($registro)) :
                    ?>
                        <tr>
                            <td><?= $reg['Nombre_usuario'] ?></td>
                            <td><?= $reg['Nombre_asesor'] ?></td>
                            <td><?= $reg['Dirección'] ?></td>
                            <td><?= $reg['Fecha'] ?></td>
                            <td><?= $reg['Hora'] ?></td>
                            <td><?= $reg['Telefono'] ?></td>
                            <td><?= $reg['Nombres'] ?></td>
                            <td><?= $reg['IdInmueble'] ?></td>
                            <td><?= $reg['Precio'] ?></td>
                            <td><?= $reg['Precio_final'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>

</html>