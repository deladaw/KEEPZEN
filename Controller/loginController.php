<?php
//Código para realizar el LOGIN de un usuario.

include("conectar_db.php");

if(isset($_POST["enviar"])){

$email = $_POST["email"];
$pwd = $_POST["password"];

$resultado= $conexion->prepare("SELECT * FROM usuarios WHERE email = ? ");
$resultado->execute([$email]);
$datos = $resultado->fetch(PDO::FETCH_OBJ);

if(isset($datos->activo) && $datos->activo == 0){
    $error_login = 'Lo sentimos, tu cuenta está desactivada, habla con el admin para reactivarla: modky@admin.com';

}else{

if ($datos && password_verify($pwd,$datos->clave)){
    
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    $_SESSION['email'] = $datos->email;
    $_SESSION['nombre_usuario'] = $datos->nombre;
    $_SESSION['id_usuario'] = $datos->id;
    $_SESSION['autentificado'] = true;
    $_SESSION['rol'] = $datos->id_rol;
    $_SESSION['tema_comprado'] = $datos->tema_comprado;
    if($datos){
        //He usado JS para redirigir porque el header me daba error.
        ?>
<script type="text/javascript">
window.location.href = "perfil.php";
</script>
<?php
    
    }
}else{
    $error_pass = '*Usuario o contraseña incorrectos';
}

}
}
?>