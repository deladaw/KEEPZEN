<?php
require_once('config.php');

$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];

$customer = \Stripe\Customer::create([
  'email' => $email,
  'source'  => $token,
]);

$charge = \Stripe\Charge::create([
  'customer' => $customer->id,
  'amount'   => 199,
  'currency' => 'eur',
]);

if ($charge->status === 'succeeded') {
  include('./Controller/conectar_db.php');
  include('./Controller/seguridad.php');
  // Actualizar el valor de "tema_comprado" del usuario
  $userId = $_SESSION['id_usuario'];
  
  $sql = "UPDATE usuarios SET tema_comprado = 1 WHERE id = :userId";
  $stmt = $conexion->prepare($sql);
  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->execute();
  
  // Redirigir a temas.php
  header('Location: temas.php');
  exit;
} else {
  // Mostrar un mensaje de error en caso de fallo en la compra
  echo '<h1>Error en la compra. Por favor, inténtalo de nuevo.</h1>';
}
?>