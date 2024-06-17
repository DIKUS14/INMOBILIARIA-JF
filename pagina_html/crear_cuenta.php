<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../codigo_css/style_crear.css">
    <!-- link de boostrap de css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- link de boostrap de css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="containero">
        <br>
        <!-- Imagen del logo -->
        <img src="../imagenes/LOGO JF cuadro.png" alt="">

        <!-- Encabezado de bienvenida -->
        <br>
        <h2 class="welcome-heading"> CREAR CUENTA
            <span class="dkp-heading"></span>
        </h2>
        <br>
        <!-- Contenedor de las casillas de entrada -->
        <div class="box ">
            <span class="borderLine"></span>
            <!-- Formulario de registro -->
            <form action="guardar_registro_usuario.php" method="POST" onsubmit="return validarContraseña()">
                <div class="container">
                    <!-- Casilla de entrada para el nombre -->
                    <div class="inputBox ">
                        <input type="text" name="nombre" placeholder="NOMBRES" required>
                        <i></i>
                    </div>
                    <br>
                    <!-- Casilla de entrada para el correo -->
                    <div class="inputBox ">
                        <input type="email" name="correo" placeholder="CORREO" required>
                        <i></i>
                    </div>
                    <br>
                    <!-- Casilla de entrada para la contraseña -->
                    <!-- <div class="inputBox ">
                        <input type="password" name="contraseña" id="contraseña" placeholder="CONTRASEÑA" required>
                        <i class="fas fa-eye"></i> -->

                        <div class="input-group mb-3">
                <span class="input-group-text toggle-password-icon" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </span>
                <input type="password" placeholder=" Contraseña" name="contraseña" id="contraseña" class="input-box form-control" required>
            </div>

                    </div>
                </div>
                <!-- Botón de crear cuenta -->
                <br>
                <center><button type="submit" class="btn btn-primary boton">CREAR CUENTA</button></center>
            </form>
            <!-- Enlace para volver al inicio de sesión -->
            <center>
                <div class="links">
                    <a href="login.php" class="forget-password ">volver</a>
            </center>
        </div>
    </div>
    </div>

    <!-- link de javascrip de bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function validarContraseña() {
            var contraseña = document.getElementById('contraseña').value;
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (!regex.test(contraseña)) {
                alert("La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.");
                return false;
            }
            return true;
        }
        
    </script>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                var tipo = $('#contraseña').attr('type');
                if (tipo === 'password') {
                    $('#contraseña').attr('type', 'text');
                    $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $('#contraseña').attr('type', 'password');
                    $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
        </script>
</body>

</html>