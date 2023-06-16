<?php
include("conectar_db.php");
include("seguridad.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $token = $_POST['token'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];

  $errores = 0;

  if ($password !== $confirmPassword) {
    $errores = 1;
    $err_pass1 = "Las contraseñas no coinciden.";
    
  }

  if (strlen($password) < 6 || !preg_match("/\d/", $password)) {
    $errores = 1;
    $err_pass2 = "La contraseña debe tener al menos 6 caracteres y contener al menos un número.";
    
  }

  if($errores != 1){

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email AND reset_token = :token");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
  
    if ($usuario) {
      $stmt = $conexion->prepare("UPDATE usuarios SET clave = :password, reset_token = NULL WHERE email = :email");
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $stmt->bindParam(':password', $hashedPassword);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
  
      header('Location: ../restablecer_contraseña_exitoso.php');
      
    } else {
      echo "El enlace de restablecimiento de contraseña es inválido.";
    }

  }
  
}
?>