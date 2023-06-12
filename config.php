<?php
define('APP_ROOT', '/ruta/a/tu/app');
require_once('vendor/autoload.php');


$stripe = array(
    
);


\Stripe\Stripe::setApiKey($stripe['secret_key']);


$coupon = \Stripe\Coupon::create([
    'percent_off' => 100, 
    'duration' => 'once', 
  ]);
  
  // Obtener el código del cupón creado
  $couponCode = $coupon->code;

?>
