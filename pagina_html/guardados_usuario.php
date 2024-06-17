<?php
include '../crudinmuebles/conexion.php';
session_start();

// Comprueba si el usuario y rol están seteados en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
} else {
    // Redirigir al usuario a la página de login si no hay datos de sesión
    header("location: login.php");
    exit();
}

// Obtener el ID de usuario de la sesión
$idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;

?>

<?php
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
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOBILIARIA JF - GUARDADOS</title>
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
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">


                    </ul>
                    </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Fin de la barra de navegacion -->



    <div class="container">
        <!-- Sección de tarjetas de inmuebles favoritos -->
        <br>
        <section class="container" id="tarjetasSection">
            <div class="text-center">
                <h1 id="ofertas-inmuebles" class="tipo-letra">INMUEBLES FAVORITOS</h1>
                <hr class="mx-auto" style="width: 21%;">
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 container justify-content-center">
                <?php

                include 'conexion.php'; // Incluir el archivo de conexión

                // Verificar si el usuario ha iniciado sesión
                if (isset($_SESSION['id_usuario'])) {
                    // Consulta para obtener los favoritos del usuario actual
                    $consulta_favoritos = "SELECT * FROM favoritos WHERE idUsuario=?";
                    $sentencia_favoritos = mysqli_prepare($con, $consulta_favoritos);

                    if (!$sentencia_favoritos) {
                        die("Error en la consulta preparada: " . mysqli_error($con));
                    }

                    // Enlazar parámetros
                    mysqli_stmt_bind_param($sentencia_favoritos, "i", $_SESSION['id_usuario']);
                    mysqli_stmt_execute($sentencia_favoritos);
                    $resultado_favoritos = mysqli_stmt_get_result($sentencia_favoritos);

                    if (mysqli_num_rows($resultado_favoritos) > 0) {
                        // Iterar sobre los resultados
                        while ($fila_favorito = mysqli_fetch_assoc($resultado_favoritos)) {
                            // Obtener la información del inmueble asociado al favorito
                            $idInmueble = $fila_favorito['idInmueble'];
                            $consulta_inmueble = "SELECT * FROM tblinmueble WHERE IdInmueble=?";
                            $sentencia_inmueble = mysqli_prepare($con, $consulta_inmueble);

                            mysqli_stmt_bind_param($sentencia_inmueble, "i", $idInmueble);
                            mysqli_stmt_execute($sentencia_inmueble);
                            $resultado_inmueble = mysqli_stmt_get_result($sentencia_inmueble);
                            $fila_inmueble = mysqli_fetch_assoc($resultado_inmueble);

                            // Verificar si hay un inmueble asociado
                            if ($fila_inmueble) {
                                // Consulta para obtener la ruta de la imagen del inmueble
                                $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
                                $resultado_imagen = mysqli_query($con, $consulta_imagen);
                                $row_imagen = mysqli_fetch_assoc($resultado_imagen);
                                $ruta_imagen = $row_imagen['RutaImagen'];

                ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <!-- Mostrar la miniatura de la imagen dentro de la tarjeta -->
                                        <img src="http://localhost/login/crudinmuebles/<?= $ruta_imagen ?>" alt="Miniatura de Inmueble" style="max-width: 100%; max-height: 200px;">
                                        <div class="card-body">
                                            <h5 class="card-title">$<?= number_format($fila_inmueble['Precio']); ?> COP <button class="favorite" onclick="removeFromFavorites(<?= $idInmueble ?>)">
                                                    <i class="bi bi-bookmark-x"></i>
                                                </button>

                                            </h5>
                                            <p class="card-text">
                                                <?= isset($fila_inmueble['Habitaciones']) ? $fila_inmueble['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                                <?= isset($fila_inmueble['Baños']) ? $fila_inmueble['Baños'] . ' Baños - ' : '' ?>
                                                <?= isset($fila_inmueble['NumeroPisos']) ? $fila_inmueble['NumeroPisos'] . ' Pisos' : '' ?>
                                            </p>
                                            <p class="card-text"><?= $fila_inmueble['Localidad']; ?></p>
                                            <!-- Enlace para ver más detalles -->
                                            <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $fila_inmueble['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>

                                        </div>
                                    </div>
                                </div>
                <?php
                            }

                            mysqli_stmt_close($sentencia_inmueble);
                        }
                    } else {
                        echo "<p>No tienes ningún inmueble guardado como favorito.</p>";
                    }
                }
                mysqli_close($con); // Cierra la conexión a la base de datos al final
                ?>
                <script>
                    function removeFromFavorites(idInmueble) {
                        // Realizar una solicitud AJAX al servidor para eliminar el inmueble de la lista de favoritos
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "eliminar_favoritos.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                // Verificar si la eliminación fue exitosa
                                if (xhr.responseText === "success") {
                                    // Si la eliminación fue exitosa, eliminar visualmente el inmueble de la lista de favoritos
                                    var card = document.querySelector(".favorite-" + idInmueble).closest(".col");
                                    card.parentNode.removeChild(card);
                                } else {
                                    // Si hubo un problema con la eliminación, mostrar un mensaje de error o manejarlo de acuerdo a tus necesidades
                                    console.error("Error al eliminar el inmueble de favoritos");
                                }
                            }
                        };
                        xhr.send("idInmueble=" + idInmueble);
                    }
                </script>


</body>

</html>