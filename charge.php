<?php
//script para procesar el pago (charge) de STRIPE.
require_once('config.php');

$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];

$customer = \Stripe\Customer::create([
  'email' => $email,
  'source'  => $token,
]);

$charge = \Stripe\Charge::create([
  'customer' => $customer->id,
  //Inmportante!!! Aquí va la cantidad de dinero en cents que se le va a cobrar al cliente de verdad.
  'amount'   => 199,
  'currency' => 'eur',
]);


//Si se ha completado el cargo, se insertan los datos en la tabla "factura"
if ($charge->status === 'succeeded') {
  include('./Controller/conectar_db.php');
  include('./Controller/seguridad.php');

  $userId = $_SESSION['id_usuario'];
  
  $sql = "UPDATE usuarios SET tema_comprado = 1 WHERE id = :userId";
  $stmt = $conexion->prepare($sql);
  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->execute();

  $fechaCompra = date('Y-m-d'); 
    $producto = 'Theme Pack';
    $precio = 1.99;
    
    $sql = "INSERT INTO factura (usuario_id, fecha_compra, producto, precio, email_compra) VALUES (:userId, :fechaCompra, :producto, :precio, :email)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':fechaCompra', $fechaCompra, PDO::PARAM_STR);
    $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
    $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
  

  header('Location: temas.php');
  exit;
} else {

  echo '<h1>Error en la compra. Por favor, inténtalo de nuevo.</h1>';
}
?>