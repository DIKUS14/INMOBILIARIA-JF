<?php
session_start();
include 'conexion.php';
include 'funciones.php';


// Llamar a la función obtenerDatosInmuebles() para obtener los datos de los inmuebles
$resultadoInmuebles = obtenerDatosInmuebles($con);

// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
} else {
    // Redirigir al usuario a la página de login si no hay datos de sesión
    header("location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOBILIARIA usuario</title>
    <link rel="stylesheet" href="../codigo_css/pag.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Google Fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">
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
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#ofertas-inmuebles">
                                <i class="bi bi-house-door-fill"></i>
                                <span style="margin-left: 5px;">Inmuebles</span> <!-- Añadido un espacio entre el icono y el texto -->
                            </a>
                        </li>

                        <span class="navbar-text">
                            <?php echo "Bienvenido, " . $usuario . " (Rol: " . $rol . ")"; ?>
                        </span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle" style="font-size: 30px;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="../pagina_html/guardados_usuario.php"><i class="bi bi-bookmark-heart"></i>Mis Favoritos</a></li>
                                <li><a class="dropdown-item" href="../crudcitas/apartados_citas.php"><i class="bi bi-calendar2-plus"></i>Mis Citas</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../pagina_html/logout.php"><i class="bi bi-box-arrow-right"></i>Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- seccion de el Carrusel -->

    <!-- // Llama a la función para imprimir el carrusel  -->
    <?php
    imprimirCarrusel();
    ?>
    <!-- fin de el Carrusel -->




    <!-- filtro para buscar inmuebles -->
    <?php
    include 'conexion.php';

    // Consulta para obtener localidades distintas
    $consultaLocalidades = "SELECT DISTINCT Localidad FROM TBLInmueble";
    $resultadoLocalidades = mysqli_query($con, $consultaLocalidades) or die("Problemas en la consulta de localidades:" . mysqli_error($con));

    // Consulta para obtener categorías
    $consultaCategorias = "SELECT * FROM TBLCategoria";
    $categorias = mysqli_query($con, $consultaCategorias) or die("Problemas en el select de categorías:" . mysqli_error($con));

    // Verifica si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Verifica si hay localidades disponibles
        if ($resultadoLocalidades->num_rows > 0) {
    ?>
            <section>
                <div class="container search">
                    <h2 class="text-center">Buscar Propiedades</h2>
                    <form action="" method="get" class="d-flex flex-wrap">
                        <div class="col-md-4 mb-3">
                            <label for="category">Categoría:</label>
                            <div class="input-group">
                                <select name="category" class="custom-select">
                                    <option value="">Todas</option>
                                    <?php
                                    while ($categoria = mysqli_fetch_assoc($categorias)) {
                                        echo '<option value="' . $categoria['Nombres'] . '">' . $categoria['Nombres'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="location">Ubicación:</label>
                            <div class="input-group">
                                <select name="location" class="custom-select">
                                    <option value="">Todas</option>
                                    <?php
                                    // Reiniciar el puntero del resultado de localidades
                                    mysqli_data_seek($resultadoLocalidades, 0);
                                    while ($localidad = mysqli_fetch_assoc($resultadoLocalidades)) {
                                        echo '<option value="' . $localidad['Localidad'] . '">' . $localidad['Localidad'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="price">Precio Máximo:</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>&nbsp;</label>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary flex-fill me-2"><i class="bi bi-search me-1"></i> </button>
                                <button type="button" class="btn btn-secondary flex-fill" id="limpiarBtn"><i class="bi bi-arrow-counterclockwise"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
    <?php
        } else {
            echo '<p>No hay localidades disponibles en la base de datos.</p>';
        }
    }
    ?>

    <script>
        // Función para redirigir a la página principal sin parámetros de búsqueda
        function limpiarFiltros() {
            window.location.href = 'entrar_usuario.php';
        }

        // Asociar la función al evento de clic del botón Limpiar
        document.getElementById('limpiarBtn').addEventListener('click', limpiarFiltros);
    </script>



    <!-- Sección de resultados de búsqueda -->
    <section class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4 container justify-content-center">
            <?php
            buscarInmuebles($con);
            ?>

        </div>
    </section>


    <!-- inicio de la seccion de la informacion de la mision de la inmobiliaria -->
    <?php
    imprimirInformacionInmobiliaria();
    ?>

    <!-- fin de la seccion de info de la mision de la inmobiliaria -->

    <a href="/codigo_css/correo _de_recuperacion.css"></a>
<br>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
    <section class="container" id="tarjetasSection">
        <div class="text-center">
            <h1 id="ofertas-inmuebles" class="tipo-letra">OFERTAS DE INMUEBLES</h1>
            <hr class="mx-auto" style="width: 21%;">
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 container justify-content-center">
            <!-- este php de generarTarjetasInmuebles llama la funcion para las tarjetas de las ofertas -->
            <?php
            generarTarjetasInmuebles($con);
            ?>

        </div>
        <div class="d-flex justify-content-center">
            <button id="verMasBtn" class="btn btn-info" style="width: 180px;">
                Ver más
                <i class="bi bi-chevron-down ms-2"></i>
            </button>
            <br>

            <button id="ocultarBtn" class="btn btn-info " style="width: 180px;" style="display: none;">
                Ocultar
                <i class="bi bi-chevron-down ms-2"></i>
            </button>
        </div>



    </section>


    </section>

    <!-- fin de la parte de favoritos  -->





    <!-- fin de la parte de favoritos  -->


    <!-- ANUNCIO -->
    <?php mostrar_anuncio("../imagenes/anuncio.jpg", "Anuncio"); ?>
    <!-- FIN DEL ANUNCIO -->



    <br>

    <!--FIN  la seccion de las tarjetas que muestran algunas casas en oferta y su informacion  -->
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <!-- Seccion de las sugerencias -->



    <!-- Fin de la seccion de las sugerencias -->

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







            <!-- Sección de contacto -->
        </div>

        <!-- Texto de derechos de autor -->
        <div class="bg-dark text-white p-3">
            <div class="container text-center">
                © 2024 Inmobiliaria JF
            </div>
        </div>
    </footer>


    <!-- FIN  Footer -->










    <!-- link del script de los botones de mostrar y ocultar -->
    <script src="../js/script.js"></script>

    <!-- Link javaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>