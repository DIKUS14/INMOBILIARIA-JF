<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOBILIARIA JF - INICIO DE SESION</title>
    <link rel="stylesheet" href="../codigo_css/style_login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
</head>

<body>
    <div class="containere">
        <!-- Imagen del logotipo -->
        <img src="../imagenes/LOGO JF cuadro.png" alt="">

        <!-- Encabezado de bienvenida -->
        <h2 class="welcome-heading"> INICIAR SESION
            <span class="dkp-heading"></span>
        </h2>

        <!-- Formulario de inicio de sesión -->
        <form action="validar.php" method="post">
            <!-- Campo de entrada para el nombre de usuario -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
                <input type="text" placeholder=" Nombres" name="usuario" id="usuario" class="input-box form-control" required>
            </div>
            <!-- Campo de entrada para la contraseña -->
            <div class="input-group mb-3">
                <span class="input-group-text toggle-password-icon" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </span>
                <input type="password" placeholder=" Contraseña" name="contraseña" id="contraseña" class="input-box form-control" required>
            </div>

            <!-- Botón de inicio de sesión -->
            <button type="submit" class="login-btn boton">E N T R A R </button>
        </form>

        <!-- Contenedor de los enlaces adicionales -->
        <div class="links-container box">
            <!-- Enlace para recuperar contraseña -->
            <center><a href="../pagina_html/recuperar_contraseña.php" class="forget-password link">¿Olvidaste tu contraseña? </a><br>
                <!-- Enlace para registrar una nueva cuenta -->
                <a href="../pagina_html/crear_cuenta.php" class="register-now link">Crear Cuenta</a>
            </center>
            <!-- Enlace para volver a la página anterior -->
            <center> <a href="#" onclick="history.back();" class="btn btn-primary"><i class="bi bi-arrow-left flecha"></i> </a></center>
        </div>
    </div>

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
