<?php
include 'conexion.php'; // Incluye el archivo 'conexion.php', el cual  contiene las credenciales de la base de datos y la configuración de la conexión.
$mensaje = ""; // Inicializa la variable $mensaje como una cadena vacía, se usa para almacenar mensajes de error o confirmación.


if (isset($_POST['guardar'])) {
    // Recoger datos del formulario
    $idInmueble = $_POST['doc'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $localidad = $_POST['localidad'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $estrato = $_POST['estrato'] ?? '';
    $areaConstruida = $_POST['Area_construida'] ?? '';
    $numBaños = $_POST['N_baños'] ?? '';
    $numHabitaciones = $_POST['N_habitaciones'] ?? '';
    $numPisos = $_POST['N_pisos'] ?? '';
    $N_cocinas = $_POST['Cocina'] ?? '';
    $garaje = $_POST['Garaje'] ?? '';
    $patio = $_POST['Patio'] ?? '';
    $estudio = $_POST['Estudio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $categoriaId = $_POST['categoria'] ?? '';
    $contacto = $_POST['contacto'] ?? '';
    $precio = str_replace('$', '', $_POST['precio'] ?? ''); // Eliminar el símbolo $// Eliminar el símbolo $
    $precio = trim($precio); // Eliminar espacios en blanco



    // Verificar que los campos requeridos no estén vacíos
    if (empty($idInmueble) || empty($localidad) || empty($direccion) || empty($estrato) || empty($areaConstruida) || empty($numBaños) || empty($numHabitaciones) || empty($numPisos) || empty($categoriaId) || empty($contacto) || empty($precio) || empty($titulo)) {
        echo '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos obligatorios.</div>';
    } else {
        // Consulta de inserción para el inmueble
        $insercion = "INSERT INTO tblinmueble (Precio, Localidad, Dirección, Estrato, Area_construida, NumeroPisos, Habitaciones, Baños, Cocina, Garaje, Patio, Estudio, Descripcion, Contacto, codigoc, Estado, Titulo) 
        VALUES ('$precio', '$localidad', '$direccion', '$estrato', '$areaConstruida', '$numPisos', '$numHabitaciones', '$numBaños', '$N_cocinas', '$garaje', '$patio', '$estudio', '$descripcion', '$contacto', '$categoriaId', '$estado', '$titulo')";

        // Ejecutar consulta de inserción del inmueble
        if (mysqli_query($con, $insercion)) {
            echo '<div class="alert alert-success" role="alert">Inmueble registrado correctamente.</div>';

            // Recoger el ID del inmueble insertado
            $idInmueble = mysqli_insert_id($con);

            // Procesar las imágenes
            if (isset($_FILES['imagenes']['name']) && is_array($_FILES['imagenes']['name'])) {
                $uploadDirectory = 'imagenes/';


                foreach ($_FILES['imagenes']['name'] as $key => $name) {
                    // Iterar sobre cada archivo de imagen recibido
                    if ($_FILES['imagenes']['error'][$key] === UPLOAD_ERR_OK) {
                        // Verificar si no hubo errores al subir el archivo
                        $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
                        // Obtener la extensión del archivo
                        $uniqueName = uniqid('img_') . '_' . time() . '.' . $fileExtension;
                        // Generar un nombre único para la imagen
                        $uploadPath = $uploadDirectory . $uniqueName;
                        // Crear la ruta completa donde se guardará la imagen en el servidor


                        // Intenta mover el archivo cargado al directorio de destino en el servidor
                        if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$key], $uploadPath)) {
                            // Si se movió correctamente, se establece la ruta de la imagen
                            $rutaImagen = $uploadPath;

                            // Prepara la consulta SQL para insertar la ruta de la imagen en la base de datos
                            $sql = "INSERT INTO imagenesinmuebles (IdInmueble, RutaImagen) VALUES ('$idInmueble', '$rutaImagen')";

                            // Ejecuta la consulta SQL
                            if (!mysqli_query($con, $sql)) {
                                // Si hay un error al ejecutar la consulta SQL, se concatena un mensaje de error a la variable $mensaje
                                $mensaje .= 'Error al guardar la ruta de la imagen en la base de datos: ' . mysqli_error($con) . '<br>';
                            }
                        } else {
                            // Si no se pudo mover el archivo cargado al directorio de destino, se concatena un mensaje de error a la variable $mensaje
                            $mensaje .= 'Error al mover el archivo cargado.<br>';
                        }
                    }
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al crear el registro: ' . mysqli_error($con) . '</div>';
        }
    }
}

if (!empty($mensaje)) {
    echo '<div class="alert alert-info" role="alert">' . $mensaje . '</div>';
}

// Procesar la imagen de ubicación
if (isset($_FILES['imagenUbicacion']['name']) && $_FILES['imagenUbicacion']['error'] === UPLOAD_ERR_OK) {
    $uploadDirectory = 'ubicacion/';

    $fileExtension = pathinfo($_FILES['imagenUbicacion']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid('ubicacion_') . '_' . time() . '.' . $fileExtension;
    $uploadPath = $uploadDirectory . $uniqueName;

    if (move_uploaded_file($_FILES['imagenUbicacion']['tmp_name'], $uploadPath)) {
        $imagenUbicacion = $uploadPath;

        // Aquí se guarda la ruta en la tabla tblinmueble
        $sql = "UPDATE tblinmueble SET Ubicacion = '$imagenUbicacion' WHERE IdInmueble = '$idInmueble'";
        if (!mysqli_query($con, $sql)) {
            $mensaje .= 'Error al guardar la ruta de la imagen de ubicación en la base de datos: ' . mysqli_error($con) . '<br>';
        }
    } else {
        $mensaje .= 'Error al mover la imagen de ubicación cargada.<br>';
    }
} else {
    $mensaje .= 'Por favor, seleccione una imagen de ubicación.<br>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Captura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="../codigo_css/createimg.css">

    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <!-- Logo en forma de icono en pestaña-->
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">

</head>

<body>
    <div class="background"></div>
    <div class="container">



        <div class="text-center">
            <h1 class="mt-5">REGISTRO DE INMUEBLES</h1>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="doc" class="form-label">Numero de Inmueble (ID)</label>
                <input type="number" class="form-control" name="doc" size="5">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Inmueble</label>
                <input type="text" class="form-control" name="titulo" size="50">
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado del Inmueble</label>
                <select class="form-select" name="estado" id="estadoSelect" onchange="changeBorderColor()">
                    <option value="Disponible">Disponible</option>
                    <option value="En proceso de adquisición">En proceso de adquisición</option>
                    <option value="No disponible">No disponible</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="imagenes" class="form-label">Subir imágenes:</label>
                <!-- Etiqueta para el campo de carga de archivos -->
                <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple id="imagenes">
                <!-- Campo de carga de archivos para subir imágenes múltiples -->
            </div>

            <div id="image-preview" class="image-preview"></div>
            <!-- Contenedor donde se mostrarán las vistas previas de las imágenes -->

            <script>
                // Script JavaScript para manejar la carga de imágenes y previsualización
                document.getElementById('imagenes').addEventListener('change', function(event) {
                    // Evento escuchador que se activa al seleccionar archivos

                    var imagePreview = document.getElementById('image-preview');
                    imagePreview.innerHTML = ''; // Limpiar el contenedor de vistas previas existentes

                    var files = event.target.files; // Obtener la lista de archivos seleccionados

                    for (var i = 0; i < files.length; i++) {
                        // Iterar sobre cada archivo seleccionado
                        (function(file) {
                            var reader = new FileReader(); // Objeto para leer el contenido del archivo

                            reader.onload = function(e) {
                                // Función que se ejecuta cuando el archivo se carga completamente

                                var imgWrapper = document.createElement('div'); // Crear un contenedor para la imagen y el botón de eliminar

                                var imgElement = document.createElement('img'); // Crear elemento de imagen
                                imgElement.src = e.target.result; // Establecer la fuente de la imagen como datos codificados en base64 del archivo

                                // No crear el botón de eliminar para eliminar la "x"

                                imgWrapper.appendChild(imgElement); // Agregar la imagen al contenedor
                                imagePreview.appendChild(imgWrapper); // Agregar el contenedor al contenedor de vistas previas
                            };

                            reader.readAsDataURL(file); // Leer el archivo como datos URL (base64)
                        })(files[i]); // Pasar cada archivo al bucle IIFE (Immediately Invoked Function Expression)
                    }
                });
            </script>





            <div class="mb-3">
                <label for="imagenUbicacion" class="form-label">Imagen de Ubicación</label>
                <input type="file" class="form-control" name="imagenUbicacion">
                <div class="invalid-feedback">
                    Por favor, seleccione una imagen de ubicación.
                </div>
            </div>


            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" placeholder="no incluir el signo $ en el precio.">
                <div class="invalid-feedback">
                    Debe incluir el signo $ en el precio.
                </div>
            </div>

            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control" name="localidad" size="10">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion" size="20" maxlength="150">
            </div>

            <div class="mb-3">
                <label for="estrato" class="form-label">Estrato</label>
                <input type="text" class="form-control" name="estrato" maxlength="1">
            </div>



            <div class="mb-3">
                <label for="Area_construida" class="form-label">Área Construida</label>
                <input type="text" class="form-control" name="Area_construida" size="10" maxlength="15">
            </div>

            <div class="mb-3">
                <label for="N_baños" class="form-label">Numero de Baños</label>
                <input type="number" class="form-control" name="N_baños" size="5">
            </div>

            <div class="mb-3">
                <label for="N_habitaciones" class="form-label">Número de Habitaciones</label>
                <input type="number" class="form-control" name="N_habitaciones" maxlength="3">
            </div>


            <div class="mb-3">
    <label for="N_pisos" class="form-label">Número de Pisos</label>
    <input type="text" class="form-control" name="N_pisos" maxlength="2">
</div>


            <div class="mb-3">
                <label for="N_cocinas" class="form-label">Numero de Cocinas</label>
                <input type="number" class="form-control" name="Cocina" size="5">
            </div>
            <div class="mb-3">
                <label for="Garaje" class="form-label">Garaje</label>
                <input type="number" class="form-control" name="Garaje" size="5">
            </div>
            <div class="mb-3">
                <label for="Patio" class="form-label">Patio</label>
                <input type="number" class="form-control" name="Patio" size="5">
            </div>
            <div class="mb-3">
                <label for="Estudio" class="form-label">Estudio</label>
                <input type="number" class="form-control" name="Estudio" size="5">
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto (Número de celular)</label>
                <input type="tel" class="form-control" name="contacto" maxlength="10" placeholder="Ejemplo: 3xxxxxxxxx">
                <div class="invalid-feedback">
                    Por favor, ingrese un número de celular válido en Colombia.
                </div>
            </div>

            <div class="form-check">
                <?php
                $registros = mysqli_query($con, "SELECT IdCategoria, Nombres FROM TBLCategoria") or die("Problemas con el select" . mysqli_error($con));
                while ($reg = mysqli_fetch_array($registros)) {
                    echo '<input class="form-check-input" type="radio" name="categoria" value="' . $reg['IdCategoria'] . '" id="categoria_' . $reg['IdCategoria'] . '">';
                    echo '<label class="form-check-label" for="categoria_' . $reg['IdCategoria'] . '">' . $reg['Nombres'] . '</label><br>';
                }
                ?>
            </div>
            <br>
            <a href="../crudcategorias/index.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Añadir Categoría
            </a>
            <br>
            <br>
            <button type="submit" class="btn btn-success" name="guardar">Guardar</button>
        </form>

        <button onclick="window.location.href = 'index.php';" class="btn btn-primary mt-3">Ir a la página principal</button>
    </div>


    <!-- link del script de los botones de mostrar y ocultar -->
    <script src="../js/script.js"></script>
    
<!-- Incluir SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Link de Bootstrap javaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>