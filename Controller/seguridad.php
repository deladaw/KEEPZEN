<?php
//Inicio la sesión 

session_status() === PHP_SESSION_ACTIVE ?: session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if (isset($_SESSION['autentificado']) &&  $_SESSION['autentificado'] !=true) {
    //si no existe, envío a la página de autentificación 
    exit();
    header("Location: index.php");
}


//además salgo de este script