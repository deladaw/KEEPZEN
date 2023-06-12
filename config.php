<?php
define('APP_ROOT', '/ruta/a/tu/app');
require_once('vendor/autoload.php');


$stripe = array(
    'secret_key' => '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',
    'publishable_key' => 'pk_live_51NHSo3EEojTiB1j2He80ZQBC61LQFhV41zm6jYzmTb1gk6qTBKu5ROKI6HdMI1xueyYD75Wt6o7Q8GeCsAK4H0Ss00ApnOam1b',
);


\Stripe\Stripe::setApiKey($stripe['secret_key']);


$coupon = \Stripe\Coupon::create([
    'percent_off' => 100, 
    'duration' => 'once', 
  ]);
  
  // Obtener el código del cupón creado
  $couponCode = $coupon->code;

?>