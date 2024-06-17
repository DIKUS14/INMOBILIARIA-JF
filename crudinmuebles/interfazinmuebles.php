<?php
include 'conexion.php';
include '../pagina_html/funciones.php';
// Obtener el ID del inmueble desde la URL
$idInmueble = isset($_GET['id']) ? $_GET['id'] : null;

// Validar que se proporcionó un ID de inmueble válido
if (!$idInmueble) {
    echo 'ID de inmueble no válido.';
    exit;
}

// Consultar la información del inmueble por su ID
$consultaInmueble = "SELECT * FROM TBLInmueble WHERE IdInmueble = $idInmueble";
$resultado = mysqli_query($con, $consultaInmueble);

// Validar que se encontró el inmueble
if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo 'Inmueble no encontrado.';
    exit;
}

// Obtener los datos del inmueble
$datosInmueble = mysqli_fetch_assoc($resultado);

$claseEstado = '';
switch ($datosInmueble['Estado']) {
    case 'Disponible':
        $claseEstado = 'text-success'; // Verde para "Disponible"
        break;
    case 'En proceso de adquisición':
        $claseEstado = 'text-warning'; // Amarillo para "En proceso de adquisición"
        break;
    case 'No disponible':
        $claseEstado = 'text-danger'; // Rojo para "No disponible"
        break;
    default:
        $claseEstado = ''; // Clase por defecto si no coincide con ningún caso
        break;
}
?>

<?php
include '../crudinmuebles/conexion.php';

session_start();

// Consulta de los datos específicos de la tabla TBLInmueble
$consultaDatos = "SELECT  TBLInmueble.Precio, TBLInmueble.Localidad, TBLInmueble.Baños, TBLInmueble.Habitaciones, TBLInmueble.NumeroPisos
                  FROM TBLInmueble 
                  INNER JOIN TBLCategoria ON TBLInmueble.codigoc = TBLCategoria.IdCategoria";

// Asegúrate de verificar si estas claves existen para evitar errores
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Sin rol';
// Ejecutar la consulta
$resultadoInmuebles = mysqli_query($con, $consultaDatos) or die("Problemas en el select:" . mysqli_error($con));



?>

<?php
// Consultar la información del inmueble por su ID
$consultaInmueble = "SELECT * FROM TBLInmueble WHERE IdInmueble = $idInmueble";
$resultado = mysqli_query($con, $consultaInmueble);

// Validar que se encontró el inmueble
if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo 'Inmueble no encontrado.';
    exit;
}

// Obtener los datos del inmueble
$datosInmueble = mysqli_fetch_assoc($resultado);

// Obtener la ruta de la imagen de la ubicación del inmueble desde la base de datos
$rutaImagenUbicacion = $datosInmueble['Ubicacion']; // Reemplaza 'ruta_imagen_ubicacion' con el nombre real de la columna en tu base de datos




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Inmueble</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../codigo_css/pag.css">

    <!-- Google Fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">

    <!-- link de los estilos de la interfaz del inmueble -->
    <link rel="stylesheet" href="../codigo_css/styleinterfazin.css">

    <!-- Logo en forma de icono en pestaña-->
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">



</head>

<body>
    <header>
        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <span> INMOBILIARIA JF </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                </div>
            </div>
        </nav>
    </header>

    <!-- fin de la barra de navegancion -->

    <!-- Estructura -->
    <div class="container">
        <?php
        // Obtener el ID del inmueble desde la URL
        $idInmueble = isset($_GET['id']) ? $_GET['id'] : null;

        ?>
        <!-- Título del inmueble -->
        <h1 class="text-center"><?= $datosInmueble['Titulo'] ?></h1>
        <!-- Título de la localidad -->
        <h1 class="text-center d-flex">Sector <?= $datosInmueble['Localidad'] ?></h1>
        <br>

        <!-- Carrusel de imágenes -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                // Consultar las imágenes del inmueble actual
                $consultaImagenes = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble";
                $resultadoImagenes = mysqli_query($con, $consultaImagenes);

                // Generar los indicadores del carrusel de imágenes
                for ($i = 0; $i < mysqli_num_rows($resultadoImagenes); $i++) {
                    echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '"';
                    if ($i === 0) {
                        echo ' class="active"';
                    }
                    echo ' aria-current="true" aria-label="Slide ' . ($i + 1) . '"></button>';
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                // Generar los elementos del carrusel de imágenes
                $active = true;
                while ($row = mysqli_fetch_assoc($resultadoImagenes)) {
                    // Obtener las dimensiones de la imagen
                    $image_info = getimagesize($row['RutaImagen']);
                    $width = $image_info[0];
                    $height = $image_info[1];
                    // Verificar si la imagen es vertical
                    $vertical_class = ($height > $width) ? ' vertical-image' : '';
                    // Calcular el ancho y la altura máximos para la imagen
                    $max_height = 500; // Puedes ajustar este valor según tus necesidades
                    $max_width = $width * ($max_height / $height);

                    echo '<div class="carousel-item';
                    if ($active) {
                        echo ' active';
                        $active = false;
                    }
                    echo '"><img src="' . $row['RutaImagen'] . '" class="d-block mx-auto carousel-img' . $vertical_class . '" style="max-height: ' . $max_height . 'px; max-width: ' . $max_width . 'px;" alt="..."></div>';
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>


        <!-- fin del carrusel de las imagenes -->


        <div class="mt-4">
            <h3>Descripción del Inmueble</h3>
            <p><?= $datosInmueble['descripcion'] ?></p>
        </div><br>
        <h3>Estado del Inmueble</h3><br>
        <h4 class="<?= $claseEstado ?>"><?= $datosInmueble['Estado'] ?></h4>

        <br><br><br><br>
        <!-- Mostrar los detalles del inmueble aquí -->

        <!-- Características del Inmueble -->
        <div class="columna row mt-12">
            <h3 class="infoinmu">Caracteristicas</h3>
            <div class="col-lg-6">
                <br>
                <div class="row">
                    <!-- Estrato -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-stack"></i>
                            <p>Estrato: <?= $datosInmueble['Estrato'] ?></p>
                        </div>
                    </div>

                    <!-- Área construida -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-rulers"></i>
                            <p>Área construida: <?= $datosInmueble['Area_construida'] ?> m²</p>
                        </div>
                    </div>

                    <!-- Pisos -->
                    <div class="col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-house-fill"></i>
                            <p>Pisos: <?= $datosInmueble['NumeroPisos'] ?></p>
                        </div>
                        <br><br>
                    </div>

                    <!-- Baños -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-droplet-half"></i>
                            <p>Baños: <?= $datosInmueble['Baños'] ?></p>
                        </div>
                    </div>

                    <!-- Habitaciones -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-house-fill"></i>
                            <p>Habitaciones: <?= $datosInmueble['Habitaciones'] ?></p>
                        </div>
                    </div>

                    <!-- Cocina -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-cookie"></i>
                            <p>Cocina: <?= $datosInmueble['Cocina'] ?></p>
                        </div>
                        <br><br>
                    </div>

                    <!-- Garaje -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-car-front-fill"></i>
                            <p>Garaje: <?= $datosInmueble['Garaje'] ?></p>
                        </div>
                    </div>

                    <!-- Patio -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-house-fill"></i>
                            <p>Patio: <?= $datosInmueble['Patio'] ?></p>
                        </div>
                    </div>

                    <!-- Estudio -->
                    <div class="columna col-lg-4">
                        <div class="property-info-box">
                            <i class="bi bi-house-fill"></i>
                            <p>Estudio: <?= $datosInmueble['Estudio'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- aca comienza la parte de el precio de el inmueble  -->
            <div class="pre col-lg-6">
                <div class="price-contact-box">

                    <h2 class="precio">Precio del Inmueble</h2>
                    <p class="ubi">Desde (COP)</p>
                    <h2 class="valor"> $ <?= $datosInmueble['Precio'] ?></h2>
                    <h3>NEGOCIABLES</h3>
                    <br>

                    <h2 class="precio">¿Te interesa este Inmueble?</h2><br>
                    <!-- Botón de activación del modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#contactModal" onclick="updateIdInmueble(<?php echo $idInmueble; ?>)">Quiero que me Contacten</button>
                    <br><br>
                    <div><button type="button" class="btn btn-info" target="_blank" onclick="window.location.href='https:/wa.me/3022767246'">Contactar por whatsapp </button>
                    </div>
                    <br>
                    <p class="ubi">consulta con un acesor y nuestras redes abajo</p>

                </div>
            </div>
        </div>

        <!-- aca termina la seccion de lso iconos de las Caracteristicas de el inmueble -->

        <br><br>
        <div class="container text-center" style="position: relative; overflow: hidden;">
            <div class="text-center">
                <h1 id="ofertas-inmuebles" class="tipo-letra">Ubicación</h1>
                <hr class="mx-auto" style="width: 21%;">
            </div>
            <img src="<?php echo $rutaImagenUbicacion; ?>" alt="Ubicación del Inmueble" style="position: relative; z-index: 1; margin: auto;">

        </div>
        <br><br>



        <section class="container" id="tarjetasSection">
            <div class="text-center">
                <h1 id="ofertas-inmuebles" class="tipo-letra">RECOMENDACIONES</h1>
                <hr class="mx-auto" style="width: 21%;">
            </div>

            <div class="container-fluid fondo" style="background-color: rgb(238, 238, 238);">
                <div id="carouselTarjetas" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php recomendaciones($con); ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTarjetas" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon black" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTarjetas" data-bs-slide="next">
                        <span class="carousel-control-next-icon black" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <br>


        <br>

    </div>


    </div>
    </div>

    <br><br>
    <!-- FOOTER -->
    <footer class="bg-light text-center text-lg-start">
        <div class="container p-4">
            <!-- Sección de enlaces del footer -->
            <section class="mb-4 text-center">
                <h1 class="text-center text-footer">INMOBILIARIA JF</h1>
            </section>
            <hr>
            <!-- Sección de enlaces del footer -->


            <!-- Sección de contacto centrada -->
            <!-- seccion de la izquierda -->
            <section class="text-center container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 mx-auto mb-5 mb-md-0">
                        <h5 class="text-uppercase">DANOS TU OPINION</h5>
                        <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button">
                            <i class="bi bi-instagram"></i>
                        </a>

                    </div>

                    <!-- seccion de el medio -->
                    <div class="col-lg-4 col-md-12 mx-auto mb-5 mb-md-0">
                        <h5 class="text-uppercase" id="contacto-inmobiliaria">Contáctanos</h5>
                        <ul class="list-unstyled contact-list">
                            <li class="d-md-flex d-block align-items-center">
                                <i class="bi bi-envelope me-3"></i>
                                <span>Correo electrónico: info@inmobiliariajf.com</span>
                            </li>
                            <li class="d-md-flex d-block  align-items-center mr-5">
                                <i class="bi bi-phone me-3"></i>
                                <span>Teléfono: +123 456 789</span>
                            </li>
                        </ul>
                    </div>

                        <!-- seccion de la derecha -->
                    <div class="col-lg-4 col-md-12 mx-auto mb-5 mb-md-0">
                        <h5 class="text-uppercase">MANUAL DE USUARIO</h5>
                        <p>Descarga nuestro manual de usuario para guías detalladas sobre el uso del sitio.</p>
                        <a href="../assets/manualusuario.pdf" class="btn btn-info" download>Descargar Manual</a>
                    </div>


                </div>
            </section>

        </div>

        <!-- Texto de derechos de autor -->
        <div class="bg-dark text-white p-3">
            <div class="container text-center">
                © 2024 Inmobiliaria JF
            </div>
        </div>
    </footer>


    <!-- Modal de contacto -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Quiero que me Contacten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="contactForm" action="../crudsolicitudes/insertar_solicitud.php" method="POST">
                        <div class="mb-3">
                            <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Número de Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <!-- Agregar un campo oculto para almacenar el ID del inmueble -->
                        <input type="hidden" name="idInmueble" id="idInmueble" value="">

                        <div class="mb-3">
                            <label for="correoElectronico" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correoElectronico" name="correoElectronico" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function updateIdInmueble(idInmueble) {
            // Actualizar el valor del campo oculto idInmueble en el formulario del modal
            document.getElementById('idInmueble').value = idInmueble;
        }
    </script>

    <!-- FIN  Footer -->

    <!-- Link de Bootstrap javaScript -->
    <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Modal Personalizado para Imágenes -->
    <div id="imageModal" class="custom-modal" style="display: none;">
        <div class="custom-modal-content">
            <span class="custom-modal-close">&times;</span>
            <img id="modalImage" class="img-fluid" src="" alt="Imagen">
        </div>
        <a class="custom-modal-prev">&#10094;</a>
        <a class="custom-modal-next">&#10095;</a>
    </div>

    <script src="../js/carrusel.js"></script>

</body>

</html>