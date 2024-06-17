<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Formulario de Contraseña</title>
  <!-- Agregar la referencia a Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../codigo_css/style_nueva.css">
</head>

<body>

  <div class="containeri mt-5">
    <div class="row justify-content-center">
      <div class="col-md-9 welcome-heading">
        <br>
        <h2 class="mb-3 ">INGRESE SU NUEVA CONTRASEÑA</h2>
        <form action="guardar_contraseña.php" method="POST" onsubmit="return validarFormulario()">
          <div class="form-group input-box">
            <br>
            <input type="text" class="form-control input_box" name="correo" id="correo" placeholder="Ingrese su correo" required>
          </div>
          <br>
          <div class="form-group input-box">

            <div class="input-group">
              <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña"required>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
           
          </div>

          <center><button type="submit" class="btn btn-primary submit" name="submit">Enviar</button></center>
        </form>
      </div>
    </div>
    <center><a href="login.php" class="link forget-password">Volver</a></center>
  </div>


  <!-- Agregar la referencia a Bootstrap JS y jQuery (requerido para Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // script.js

    $(document).ready(function() {
      $('#togglePassword').click(function() {
        var tipo = $('#contrasena').attr('type');
        if (tipo === 'password') {
          $('#contrasena').attr('type', 'text');
          $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          $('#contrasena').attr('type', 'password');
          $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
    });


    function validarFormulario() {
      var contraseña = document.getElementById('contrasena').value;
      var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
      if (!regex.test(contraseña)) {
        alert("La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.");
        return false;
      }
      return true;
    }
  </script>
  <!-- link del script de los botones de mostrar y ocultar -->
  <script src="../js/gestionar_contraseña.js"></script>
</body>

</html>
