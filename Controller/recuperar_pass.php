<?php
//Código para recuperar la contraseña sin haber hecho el login. Se envía por email.
include("conectar_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];

  ini_set('SMTP', 'servidor_smtp');
ini_set('smtp_port', 'puerto_smtp');

  $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario) {

    $token = bin2hex(random_bytes(32));

    $stmt = $conexion->prepare("UPDATE usuarios SET reset_token = :token WHERE email = :email");
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $subject = 'Recuperación de contraseña';
    $message = "Hola " . $usuario['nombre'] . ",\n\n";
    $message .= "Hemos recibido una solicitud para restablecer tu contraseña. Si no has solicitado esto, puedes ignorar este correo electrónico.\n\n";
    $message .= "Para restablecer tu contraseña, haz clic en el siguiente enlace:\n";
    $message .= "http://keepzen.es/restablecer_contraseña.php?email=" . urlencode($email) . "&token=" . urlencode($token) . "\n\n";
    $message .= "Si el enlace no funciona, copia y pega la URL en tu navegador.\n\n";
    $message .= "Gracias,\n";
    $message .= "Tu sitio web";
 
    $headers = "From: KEEPZEN <noreply@keepzen.com>";
    mail($email, $subject, $message, $headers);

    header('Location: ../email_enviado.php');
  } else {
    echo "No se encontró ningún usuario con esa dirección de correo electrónico.";
  }
}
?>