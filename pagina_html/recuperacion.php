<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('conexion.php');
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$email = $_POST['email'];
$query = "SELECT * FROM tblusuarios WHERE correo = '$email' AND password = 'contraseña'";

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp-mail.outlook.com";
    $mail->Port = 587;
    $mail->Username = "inmobiliaria_JF14@hotmail.com";
    $mail->Password = "realstate14";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Recipients
    $mail->setFrom('inmobiliaria_JF14@hotmail.com', 'INMOBILIARIA JF');
    $mail->addAddress($email);

    // URL a la que deseas redirigir
    $resetPasswordURL = "http://localhost/login/pagina_html/nueva_contrase%C3%B1a.php";

    // Contenido HTML con imagen de fondo
    $mail->Body = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                margin: 0;
                padding: 0;
            }
            .container {
                margin: 0 auto;
                max-width: 600px;
                padding: 20px;
                background-image: url(https://i.ibb.co/dgFpvdx/correo.png);
                border-radius: 10px;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                height: 55%;
            }
            h1 {
                color: #ffffff;
                
            }
            .message {
                margin-top: 20px;
                background-color: rgba(194, 222, 231, 0.856);
                padding: 10px;
                border-radius: 10px;
            }
            .boton {
                display: inline-block;
                background-color: rgb(240, 240, 240);
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                text-decoration: none;
                font-size: 16px;
                cursor: pointer;
            }
          
        </style>
    </head>
    <body>
        
        <br><br><br><br>
    <div class="container">
        <br><br><br><br><br><br><br><br>
     <center>   <h1 class="titulo">Recuperación de contraseña</h1></center>
        <div class="message">
          <center> <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en INMOBILIARIA JF. Para completar este proceso, haz clic en el siguiente botón:</p></center> 
            <center><a href="' . $resetPasswordURL . '" class="boton">Restablecer contraseña</a>
</center>
           <center> <p>Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje. Tu contraseña actual seguirá siendo válida.</p></center>
        </div>
    </div>
    </body>
    </html>
    ';
    
    $mail->AltBody = 'El texto como elemento de texto simple'; // Texto plano alternativo
    
    // Configurar la codificación
    $mail->CharSet = 'UTF-8';
    
    $mail->send();
} catch (Exception $e) {
    echo "Mailer Error: " . $e->getMessage();
}
?>
