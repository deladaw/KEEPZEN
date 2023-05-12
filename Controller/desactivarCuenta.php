<?php
//Código para DESACTIVAR un usuario.
include 'seguridad.php';
include("./Model/conectar_db.php");

if (isset($_GET["id"])) {

    $id = $_GET["id"]; 
    $sql = $conexion->prepare("UPDATE usuarios SET activo = 0, fecha_baja = NOW() WHERE usuario = ?");

    $res = $sql->execute([$id]);

    //si el id a borrar es el del usuario que ha iniciado sesión, se destruye
    if($_SESSION['usuario'] == $id){
        session_destroy();
        header("Location: ../index.php", true, 303);
        exit();
    }

    if ($res) {

        if($_SESSION['rol'] == 1){
            
            header("Location: ../perfil_admin.php", true, 303);
            exit();
        }else{
            header("Location: ../perfil_usuario.php", true, 303);
            exit();
            
        }

    }
}
?>