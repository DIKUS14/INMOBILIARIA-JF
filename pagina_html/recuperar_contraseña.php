<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="../codigo_css/style_recupera.css">
</head>

<body>
  <div class="containeri">
    <br>
    <img src="../imagenes/LOGO JF cuadro.png" alt="">

    <form action="recuperacion.php" method="post">
      <center>
        <h2 class="welcome-heading">RECUPERAR CONTRASENA</h2>

        <br>
        <p>Ingresa tu dirección de Correo electrónico para recuperar tu contraseña:</p><br>
      </center>

      <input type="email" name="email" placeholder="email Electrónico" required>

      <center><button type="submit" class="btn btn-primary submit">Enviar</button></center>
      <center><a href="login.php " class="link forget-password ">Volver</a></center>
  </div>
  </form>
</body>

</html>