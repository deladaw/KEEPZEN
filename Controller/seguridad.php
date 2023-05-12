<?php
//Inicio la sesión 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//además salgo de este script