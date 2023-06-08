<?php
//Código del Login de los usuarios
include("conectar_db.php");

if(isset($_POST["enviar"])){


$email = $_POST["email"];
$email2 = $_POST["email2"];
$pwd = $_POST["password"];

//Comprobación de los DATOS de LOGIN AND activo = 1
$resultado= $conexion->prepare("SELECT * FROM usuarios WHERE email = ? ");
$resultado->execute([$email]);
$datos = $resultado->fetch(PDO::FETCH_OBJ);

//Si el usuario está dado de baja, tiene que comunicarse con el admin para reactivar su cuenta y no podrá hacer login.
}
?>