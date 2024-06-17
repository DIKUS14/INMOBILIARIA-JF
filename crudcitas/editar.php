<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <!-- Agrega los enlaces a Bootstrap CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-kmK5I3Fo5w5f5krZ5R5u1Cqz5pRbAUO9RkPrqer2fFt5f5z5D5F5f5f5f5f5f5f5f5f5" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">

</head>

<body>
<div class="background"></div>
    <?php
    // Incluye el archivo de conexión a la base de datos
    include 'conexion.php';

    // Verifica si se ha proporcionado un ID de cita válido
    if (isset($_GET['id'])) {
        $idCita = $_GET['id'];

        // Realiza la consulta para obtener los datos de la cita correspondiente al ID
        $consulta = "SELECT * FROM TBLCita WHERE IdCita = $idCita";
        $resultado = mysqli_query($con, $consulta);

        // Verifica si se encontró la cita
        if (mysqli_num_rows($resultado) === 1) {
            $cita = mysqli_fetch_assoc($resultado);
        } else {
            echo '<div class="alert alert-danger" role="alert">Cita no encontrada.</div>';
            exit;
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">ID de cita no proporcionado.</div>';
        exit;
    }

    // Procesa la actualización 
    if (isset($_POST['actualizar'])) {
        $nombre_actualizado = $_POST['nombre'];
        $direccion_actualizada = $_POST['direccion'];
        $fecha_actualizada = $_POST['fecha'];
        $hora_actualizada = $_POST['hora'];
        $telefono_actualizado = $_POST['telefono'];
        $categoria_actualizada = $_POST['categoria'];
        $inmueble_actualizado = $_POST['inmueble']; // Nuevo campo para el ID del inmueble
        $asesor_actualizado = $_POST['nombre_asesor'];
        $precio_final_actualizado = $_POST['precio_final'];

        // Actualiza los datos en la base de datos
        $actualizar = "UPDATE TBLCita 
                      SET Nombre_usuario = '$nombre_actualizado',
                          Dirección = '$direccion_actualizada', 
                          Fecha = '$fecha_actualizada',
                          Hora = '$hora_actualizada',
                          Telefono = '$telefono_actualizado', 
                          codigoc = '$categoria_actualizada',
                          infoinmueble = '$inmueble_actualizado',
                          Nombre_asesor = '$asesor_actualizado',
                          Precio_final = '$precio_final_actualizado'
                      WHERE IdCita = $idCita";

        if (mysqli_query($con, $actualizar)) {
            echo '<div class="alert alert-success" role="alert">Cita actualizada correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al actualizar la cita: ' . mysqli_error($con) . '</div>';
        }
    }
    ?>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Editar Cita</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $cita['Nombre_usuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $cita['Dirección']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="<?php echo $cita['Fecha']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" name="hora" value="<?php echo $cita['Hora']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $cita['Telefono']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre_asesor" class="form-label">Nombre del Asesor</label>
                <input type="text" class="form-control" name="nombre_asesor" value="<?php echo $cita['Nombre_asesor']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio_final" class="form-label">Precio Final</label>
                <input type="text" class="form-control" name="precio_final" value="<?php echo $cita['Precio_final']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="inmueble" class="form-label">Seleccionar Inmueble</label>
                <select class="form-control" name="inmueble" required>
                    <option value="" disabled>Selecciona un inmueble</option>

                    <?php
                    // Consulta para obtener los inmuebles de la base de datos
                    $consultaInmuebles = "SELECT IdInmueble, Dirección FROM TBLInmueble";
                    $inmuebles = mysqli_query($con, $consultaInmuebles) or die("Problemas con la consulta de inmuebles: " . mysqli_error($con));

                    // Muestra las opciones de inmuebles en un select
                    while ($inmueble = mysqli_fetch_array($inmuebles)) {
                        $selected = ($inmueble['IdInmueble'] == $cita['infoinmueble']) ? 'selected' : '';
                        echo '<option value="' . $inmueble['IdInmueble'] . '" ' . $selected . '>' . $inmueble['Dirección'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Seleccionar Categoría</label><br>

                <?php
                // Consulta para obtener las categorías de la base de datos
                $registros = mysqli_query($con, "SELECT IdCategoria, Nombres FROM TBLCategoria") or die("Problemas con el select de categorías: " . mysqli_error($con));
                while ($reg = mysqli_fetch_array($registros)) {
                    $checked = ($reg['IdCategoria'] == $cita['codigoc']) ? 'checked' : '';
                    // Muestra opciones de radio para seleccionar la categoría
                    echo '<input class="form-check-input" type="radio" name="categoria" value="' . $reg['IdCategoria'] . '" id="categoria_' . $reg['IdCategoria'] . '" ' . $checked . '>';
                    echo '<label class="form-check-label" for="categoria_' . $reg['IdCategoria'] . '">' . $reg['Nombres'] . '</label><br>';
                }
                ?>
            </div>
            <div class="mb-3 d-grid gap-2">
                <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                <a href="javascript:history.go(-1)" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</body>

</html>