<?php
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



<?php
function obtenerDatosInmuebles($con)
{
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

    // Ejecutar la consulta
    $resultadoInmuebles = mysqli_query($con, $consultaDatos) or die("Problemas en el select:" . mysqli_error($con));

    return $resultadoInmuebles;
}
?>




<?php
function buscarInmuebles($con)
{
    // Verificar si se han enviado parámetros de búsqueda
    if (isset($_GET['location']) || isset($_GET['price']) || isset($_GET['category'])) {
        // Construir la consulta SQL base
        $query = "SELECT * FROM tblinmueble WHERE 1";

        // Verificar y agregar condiciones de filtrado según los parámetros recibidos
        if (isset($_GET['location']) && !empty($_GET['location'])) {
            $localidad = $_GET['location'];
            $query .= " AND Localidad = '$localidad'";
        }
        if (isset($_GET['price']) && !empty($_GET['price'])) {
            $precio_maximo = $_GET['price'];
            $query .= " AND Precio <= $precio_maximo";
        }
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $categoria = $_GET['category'];
            // Obtener el ID de la categoría
            $consulta_categoria = "SELECT IdCategoria FROM tblcategoria WHERE Nombres = '$categoria'";
            $resultado_categoria = mysqli_query($con, $consulta_categoria);

            if ($row_categoria = mysqli_fetch_assoc($resultado_categoria)) {
                $id_categoria = $row_categoria['IdCategoria'];
                $query .= " AND codigoc = $id_categoria";
            } else {
                // La categoría no existe, manejar este caso según tu lógica de aplicación
            }
        }

        // Ejecutar la consulta SQL
        $resultadoInmuebles = mysqli_query($con, $query);

        if ($resultadoInmuebles->num_rows > 0) {
            while ($reg = $resultadoInmuebles->fetch_assoc()) {
                // Consultar la ruta de la imagen del inmueble
                $idInmueble = $reg['IdInmueble'];
                $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
                $resultado_imagen = mysqli_query($con, $consulta_imagen);
                $ruta_imagen = "";

                if ($row_imagen = mysqli_fetch_assoc($resultado_imagen)) {
                    $ruta_imagen = $row_imagen['RutaImagen'];
                }

?>
                <div class="col">
                    <div class="card h-100">
                        <!-- Mostrar la imagen dentro de la tarjeta -->
                        <img src="http://localhost/login/crudinmuebles/<?= $ruta_imagen ?>" alt="Imagen de Inmueble" style="max-width: 100%; max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP <button class="favorite" onclick="toggleBookmark(<?= $idInmueble ?>)">
                                    <i class="bi bi-bookmark bookmark bookmark-<?= $idInmueble ?>"></i>
                                    <i class="bi bi-bookmark-fill bookmark-fill bookmark-fill-<?= $idInmueble ?>"></i>
                                </button>
                                </a>

                            </h5>
                            <p class="card-text <?= estadoColor($reg['Estado']) ?>"><?= $reg['Estado']; ?></p>
                            <p class="card-text">
                                <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                            </p>
                            <p class="card-text"><?= $reg['Localidad']; ?></p>
                            <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>
                        </div>
                    </div>
                </div>
<?php
            }
        } else {
            echo '<p class="text-center">No se encontraron resultados.</p>';
        }
    }
}
?>






<?php
function generarTarjetasInmuebles($con)
{
    // Consulta para obtener los resultados de la base de datos
    $resultadoInmuebles = mysqli_query($con, "SELECT * FROM tblinmueble") or die("Problemas con el select" . mysqli_error($con));

    if ($resultadoInmuebles->num_rows > 0) {
        while ($reg = $resultadoInmuebles->fetch_assoc()) {
            // Consulta para obtener la ruta de la imagen del inmueble
            $idInmueble = $reg['IdInmueble'];
            $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
            $resultado_imagen = mysqli_query($con, $consulta_imagen);

            // Verifica si se encontró la imagen
            if ($row_imagen = mysqli_fetch_assoc($resultado_imagen)) {
                $ruta_imagen = $row_imagen['RutaImagen'];
?>

                <div class="col">
                    <div class="card h-100">
                        <!-- Mostrar la miniatura de la imagen dentro de la tarjeta -->
                        <img src="http://localhost/login/crudinmuebles/<?= $ruta_imagen ?>" alt="Miniatura de Inmueble" style="max-width: 100%; max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP <button class="favorite" onclick="toggleBookmark(<?= $idInmueble ?>)">
                                    <i class="bi bi-bookmark bookmark bookmark-<?= $idInmueble ?>"></i>
                                    <i class="bi bi-bookmark-fill bookmark-fill bookmark-fill-<?= $idInmueble ?>"></i>
                                </button>


                            </h5>
                            <p class="card-text <?= estadoColor($reg['Estado']) ?>"><?= $reg['Estado']; ?></p>
                            <p class="card-text">
                                <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                            </p>
                            <p class="card-text"><?= $reg['Localidad']; ?></p>
                            <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                // Si no se encontró la imagen, muestra un mensaje de error o una imagen de marcador de posición
            ?>
                <div class="col">
                    <div class="card h-100">
                        <!-- Mostrar una imagen de marcador de posición o un mensaje de error -->
                        <p class="text-center">No hay imagen disponible</p>
                        <div class="card-body">
                            <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP</h5>
                            <p class="card-text">
                                <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                            </p>
                            <p class="card-text"><?= $reg['Localidad']; ?></p>
                            <button class="favorite" onclick="guardarTarjetaFavorita(<?= $reg['IdInmueble']; ?>)">
                                <i class="bi bi-bookmark" id="bookmark"></i>
                                <i class="bi bi-bookmark-fill" id="bookmark-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
<?php
            }
        }
    } else {
        echo '<p class="text-center">No hay inmuebles registrados.</p>';
    }
    // Script JavaScript que deseas ejecutar junto con la generación de las tarjetas
    echo '<script src="../js/script.js"></script>';
}

?>


<?php
function imprimirCarrusel()
{
    echo '
    <section class="carrusel-casas" id="carouselExampleAutoplaying">
        <div id="slider-casas" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active carrusel-imagen1">
                    <img src="../imagenes/carrusel/imagencarrusel1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>BIENVENIDO A INMOBILIARIA JF</h5>
                        <p>Esperamos brindarte la mejor experiencia</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../imagenes/carrusel/imagencarrusel2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tu confianza es Nuestra prioridad</h5>
                        <p>Agradecemos que nos elijas</p>
                    </div>
                </div>
                <div class="carousel-item carrusel-imagen3">
                    <img src="../imagenes/carrusel/imagencarrusel3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Descubre nuevas oportunidades</h5>
                        <p>Explora nuestro catálogo de propiedades</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    ';
}

?>


<?php
function imprimirInformacionInmobiliaria()
{
    echo '
    <section class="info">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 pt-4 pt-lg-0 order-1 order-lg-1 content text-center" data-aos="fade-left">
                    <img src="../imagenes/informacion.jpg" class="img-fluid custom-img-fluid " alt="Imagen Informativa">
                </div>
                <div class="col-lg-6 order-2 order-lg-2 text-center" data-aos="fade-right">
                    <h3 class="mb-4 tipo-letra">Descubre lo que Inmobiliaria JF te ofrece</h3>
                    <p>
                        Inmobiliaria JF te va a proporcionar la mejor experiencia al buscar tu hogar ideal. Nuestro
                        equipo está dedicado a ofrecer información detallada de las propiedades para que tomes
                        decisiones informadas. Explora una amplia variedad de propiedades que se adaptan a tus
                        necesidades y facilita el proceso de contacto para que puedas obtener más detalles y explorar
                        las opciones disponibles de tal manera que puedas obtener el inmueble de tus sueños.
                    </p>

                    <div class="text-center">
                        <ul class="list-unstyled  d-inline-flex">
                            <li class="justify-content-start ">
                                <i class="bi bi-check-circle me-2"></i>
                                <span>Obtén información detallada de las propiedades</span>
                            </li>
                            <li class="align-items-center justify-content-center me-3">
                                <i class="bi bi-check-circle me-2"></i>
                                <span>Explora una amplia variedad de propiedades</span>
                            </li>
                            <li class="align-items-center justify-content-center">
                                <i class="bi bi-check-circle me-2"></i>
                                <span>Facilita el proceso de contacto</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    ';
}
?>

<?php
function generarBarraNavegacion($usuario, $rol)
{
?>
    <header>
        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
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
<?php
}
?>

<?php
function mostrar_anuncio($imagen_src, $alt_text)
{
    echo '<div class="container custom-container">';
    echo '<img src="' . $imagen_src . '" class="custom-img-fluid" alt="' . $alt_text . '">';
    echo '</div>';
}
?>


<?php
// Definir la función recomendaciones
function recomendaciones($con)
{
    // Consulta para obtener los resultados de la base de datos
    $resultadoInmuebles = mysqli_query($con, "SELECT * FROM tblinmueble") or die("Problemas con el select" . mysqli_error($con));

    if ($resultadoInmuebles->num_rows > 0) {
        $first = true;
        while ($reg = $resultadoInmuebles->fetch_assoc()) {
            // Consulta para obtener la ruta de la imagen del inmueble
            $idInmueble = $reg['IdInmueble'];
            $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
            $resultado_imagen = mysqli_query($con, $consulta_imagen);

            // Verifica si se encontró la imagen
            if ($row_imagen = mysqli_fetch_assoc($resultado_imagen)) {
                $ruta_imagen = $row_imagen['RutaImagen'];
?>
                <div class="carousel-item <?php if ($first) echo 'active'; ?>">
                    <div class="row row-cols-1 row-cols-md-3 g-4 container justify-content-center">
                        <div class="col">
                            <div class="card h-100">
                                <!-- Mostrar la miniatura de la imagen dentro de la tarjeta -->
                                <img src="http://localhost/login/crudinmuebles/<?= $ruta_imagen ?>" alt="Miniatura de Inmueble" style="max-width: 100%; max-height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP</h5>
                                    <p class="card-text <?= estadoColor($reg['Estado']) ?>"><?= $reg['Estado']; ?></p><br>
                                    <p class="card-text">
                                        <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                        <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                        <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                                    </p>
                                    <p class="card-text"><?= $reg['Localidad']; ?></p><br>
                                    <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
                $first = false;
            }
        }
    } else {
        echo '<p class="text-center">No hay inmuebles registrados.</p>';
    }
}
?>

