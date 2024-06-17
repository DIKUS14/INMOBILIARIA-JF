<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Verifica si se ha enviado el formulario para crear una nueva cita
if (isset($_POST['crear'])) {
    // Obtiene los valores enviados desde el formulario
    $usuarioId = $_POST['usuario'];
    $nombre = $_POST['nombre']; // Nombre del usuario de la cita
    $asesor = $_POST['asesor']; // Nombre del asesor de la cita
    $direccion = $_POST['direccion']; // Dirección de la cita
    $fecha = $_POST['fecha']; // Fecha de la cita
    $hora = $_POST['hora']; // Hora de la cita
    $telefono = $_POST['telefono']; // Teléfono de la cita
    $categoriaId = $_POST['categoria']; // ID de la categoría de la cita
    $inmuebleId = $_POST['inmueble']; // ID del inmueble de la cita
    $precioFinal = $_POST['precio']; // Precio final de la cita

    // Realiza la inserción en la tabla TBLCita
    $insercion = "INSERT INTO TBLCita (IdUsuario, Nombre_usuario, Nombre_asesor, Dirección, Fecha, Hora, Telefono, codigoc, infoinmueble, Precio_final) VALUES ('$usuarioId', '$nombre', '$asesor', '$direccion', '$fecha', '$hora', '$telefono', '$categoriaId', '$inmuebleId', '$precioFinal')";
    if (mysqli_query($con, $insercion)) {
        // Muestra un mensaje de éxito si la inserción fue exitosa
        echo '<script>alert("Registro creado exitosamente.");</script>';
    } else {
        // Muestra un mensaje de error si hubo algún problema con la inserción
        echo '<script>alert("Error al crear el registro: ' . mysqli_error($con) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Crear Registro</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../codigo_css/crudstyles.css">
    <link rel="icon" type="image/png" href="../imagenes/LOGO JF.png">
</head>

<body>
<div class="background"></div>

    

    <div class="container">
        <div class="row">
            <div class="col-a text-center">
                <h2>REGISTRAR CITAS</h2>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-6 offset-3">
                <form action="create.php" method="post">
                    <div>
                        <label for="usuario" class="form-label">Seleccionar Usuario</label>
                        <select class="form-control" name="usuario" required>
                            <option value="" disabled selected>Selecciona un usuario</option>
                            <?php
                            // Consulta para obtener los usuarios de la base de datos
                            $consultaUsuarios = "SELECT id, Nombres FROM tblusuarios";
                            $usuarios = mysqli_query($con, $consultaUsuarios) or die("Problemas con la consulta de usuarios" . mysqli_error($con));

                            // Muestra las opciones de usuarios en un select
                            while ($usuario = mysqli_fetch_array($usuarios)) {
                                echo '<option value="' . $usuario['id'] . '">' . $usuario['Nombres'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>

                    <div>
                        <label for="nombre" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Digita el nombre completo" required>
                    </div>
                    <br>
                    <div>
                        <label for="asesor" class="form-label">Nombre del asesor</label>
                        <input type="text" class="form-control" name="asesor" placeholder="Digita el nombre del asesor" required>
                    </div>
                    <br>
                    <div>
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Digita la dirección" required>
                    </div>
                    <br>
                    <div>
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" placeholder="Ingresa la fecha" required>
                    </div>
                    <br>
                    <div>
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" name="hora" placeholder="Ingresa la hora" required>
                    </div>
                    <br>
                    <div>
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" name="telefono" placeholder="Digita el número de teléfono" required>
                    </div>
                    <br>
                    <div>
                        <label for="inmueble" class="form-label">Seleccionar Inmueble</label>
                        <select class="form-control" name="inmueble" required>
                            <option value="" disabled selected>Selecciona un inmueble</option>
                            <?php
                            // Consulta para obtener los inmuebles de la base de datos
                            $consultaInmuebles = "SELECT IdInmueble, Dirección FROM tblinmueble";
                            $inmuebles = mysqli_query($con, $consultaInmuebles) or die("Problemas con el consulta de inmuebles" . mysqli_error($con));

                            // Muestra las opciones de inmuebles en un select
                            while ($inmueble = mysqli_fetch_array($inmuebles)) {
                                echo '<option value="' . $inmueble['IdInmueble'] . '">' . $inmueble['Dirección'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>

                    <div>
                        <label for="precio" class="form-label">Precio final</label>
                        <input type="text" class="form-control" name="precio" placeholder="Digita el precio final" required>
                    </div>
                    <br><br>
                    <div class="form-check">
                        <?php
                        // Consulta para obtener las categorías de la base de datos
                        $registros = mysqli_query($con, "SELECT IdCategoria, Nombres FROM tblcategoria") or die("Problemas con el select" . mysqli_error($con));
                        while ($reg = mysqli_fetch_array($registros)) {
                            // Muestra opciones de radio para seleccionar la categoría
                            echo '<input class="form-check-input" type="radio" name="categoria" value="' . $reg['IdCategoria'] . '" id="categoria_' . $reg['IdCategoria'] . '">';
                            echo '<label class="form-check-label" for="categoria_' . $reg['IdCategoria'] . '">' . $reg['Nombres'] . '</label><br>';
                        }
                        ?>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-success w-100" name="crear">ADICIONAR</button>
                </form>
                <a href="index.php" class="btn btn-primary mt-3">Volver</a>
            </div>
        </div>
    </div>

</body>

</html>