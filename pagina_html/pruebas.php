<?php
include '../crudinmuebles/conexion.php';

session_start();
// // Comprueba si el usuario y rol están seteados en la sesión
// if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
//     $usuario = $_SESSION['usuario'];
//     $rol = $_SESSION['rol'];
// } else {
//     // Redirigir al usuario a la página de login si no hay datos de sesión
//     header("location: login.php");
//     exit();
// }
// Consulta de los datos específicos de la tabla TBLInmueble
$consultaDatos = "SELECT  TBLInmueble.Precio, TBLInmueble.Localidad, TBLInmueble.Baños, TBLInmueble.Habitaciones, TBLInmueble.NumeroPisos
                  FROM TBLInmueble 
                  INNER JOIN TBLCategoria ON TBLInmueble.codigoc = TBLCategoria.IdCategoria";

// Verificar si se han enviado parámetros de búsqueda
if (isset($_GET['location']) || isset($_GET['price']) || isset($_GET['category'])) {
    $consultaDatos .= " WHERE 1"; // Iniciar la condición WHERE

    // Verificar si se ha seleccionado una ubicación
    if (isset($_GET['location']) && !empty($_GET['location'])) {
        // Filtrar por la ubicación seleccionada
        $ubicacion = mysqli_real_escape_string($con, $_GET['location']);
        $consultaDatos .= " AND TBLInmueble.Localidad LIKE '%$ubicacion%'";
    }

    // Verificar si se ha seleccionado un precio máximo
    if (isset($_GET['price']) && !empty($_GET['price'])) {
        // Filtrar por el precio máximo seleccionado
        $precioMaximo = mysqli_real_escape_string($con, $_GET['price']);
        $consultaDatos .= " AND TBLInmueble.Precio <= $precioMaximo";
    }

    // Filtrar por categoría si se proporciona
    if (isset($_GET['category'])) {
        $categoriaSeleccionada = mysqli_real_escape_string($con, $_GET['category']);
        $consultaDatos .= " AND TBLCategoria.Nombres = '{$categoriaSeleccionada}'";
    }
}
// Asegúrate de verificar si estas claves existen para evitar errores
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Sin rol';
// Ejecutar la consulta
$resultadoInmuebles = mysqli_query($con, $consultaDatos) or die("Problemas en el select:" . mysqli_error($con));


// la siguiente funcion es para el color de el estado de el inmueble
function estadoColor($estado)
{
    switch ($estado) {
        case 'Disponible':
            return 'text-success'; // Color verde
        case 'En proceso de adquisición':
            return 'text-warning'; // Color amarillo
        case 'No disponible':
            return 'text-danger'; // Color rojo
        default:
            return ''; // Por defecto, no aplicar ningún color
    }
}
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBAS</title>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




</head>

<body>

<header>
        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">
                    <span style="font-size: 25px; margin-left: 1px;">
                        <?php echo "Bienvenido, " . $usuario; ?>
                        <span style="color: black; font-size: 15px; margin-left: 10px;">
                            <?php echo " (" . $rol . ")"; ?>
                        </span>
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../pagina_html/entrar_admin.php">
                                <i class="bi bi-house-fill" style="margin-right: 5px;"></i>
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crudusuarios/index.php">
                                <i class="bi bi-person-add" style="margin-right: 5px;"></i>
                                Añadir Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crudcitas/index.php">
                                <i class="bi bi-calendar2-plus" style="margin-right: 5px;"></i>
                                Añadir Cita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crudsolicitudes/index.php">
                                <i class="bi bi-calendar-check" style="margin-right: 5px;"></i>
                                Solicitudes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crudinmuebles/index.php">
                                <i class="bi bi-house-add" style="margin-right: 5px;"></i>
                                Añadir Inmueble
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- fin de la barra de navegacion -->








    <!-- seccion de el Carrusel -->

    <section class="carrusel-casas" id="carouselExampleAutoplaying">
        
            <div class="carousel-inner">
                <!-- primera imagen de el carrusel -->
                <div class="carousel-item active carrusel-imagen1">
                    <img src="../imagenes/carrusel/imagencarrusel1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>BIENVENIDO A INMOBILIARIA JF</h5>
                        <p>Esperamos brindarte la mejor experiencia</p>
                    </div>
                </div>
                <!-- segunda imagen de el carrusel -->
                <div class="carousel-item">
                    <img src="../imagenes/carrusel/imagencarrusel2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tu confianza es Nuestra prioridad</h5>
                        <p>Agradecemos que nos elijas</p>
                    </div>
                </div>
                <!-- tercera imagen de el carrusel -->
                <div class="carousel-item carrusel-imagen3">
                    <img src="../imagenes/carrusel/imagencarrusel3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Descubre nuevas oportunidades</h5>
                        <p>Explora nuestro catálogo de propiedades</p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slider-casas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slider-casas" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>

        </div>
    </section>
    <!-- fin de el Carrusel -->


   



        <!-- fin de la parte de favoritos  -->




        <!-- link del script de los botones de mostrar y ocultar -->
        <script src="../js/script.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>


        <!-- Link javaScript Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>