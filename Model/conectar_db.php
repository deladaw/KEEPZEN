<?php
//Conexión con la base de datos.
try{

    $conexion =  new PDO("mysql:host=localhost; dbname=keepzen", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $err){

    die("Error: ". $err->getMessage() ."No se ha podido contectar a la base de datos.");
    $conexion->exec("SET CHARACTER SET utf8");

}



?>