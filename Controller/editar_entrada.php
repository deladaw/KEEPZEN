<?php
//Código para la edición de una entrada de agradecimiento.
include("conectar_db.php"); 
include("seguridad.php"); 

if(isset($_REQUEST['editar'])){


    $id_entrada = $_POST['id_entrada']; 
    $nuevo_contenido = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8'); 
    $id_usuario = $_SESSION['id_usuario'];
    
    $errores = 0;
    
    if (empty($nuevo_contenido)) {
        $err_vacio = "* No has escrito ningún agradecimiento";
        $errores = 1;
    }
    
    if (strlen($nuevo_contenido) > 3000) {
        $nuevo_contenido = substr($nuevo_contenido, 0, 3000);
        $err_textLG = "* Texto demasiado largo. El máximo permitido es de 2000 caracteres.";
        $errores = 1;
    }
    
    // Verificar si la entrada pertenece al usuario actual antes de actualizarla
    $sql_verificacion = "SELECT id FROM agradecimientos WHERE id = ? AND id_usuario = ?";
    $stmt_verificacion = $conexion->prepare($sql_verificacion);
    $stmt_verificacion->execute([$id_entrada, $id_usuario]);
    
    if ($stmt_verificacion->rowCount() > 0 && $errores != 1) {
        
        $sql_actualizacion = "UPDATE agradecimientos SET agradecimiento = ? WHERE id = ?";
        $stmt_actualizacion = $conexion->prepare($sql_actualizacion);
        $stmt_actualizacion->execute([$nuevo_contenido, $id_entrada]);
    
        header("Location: entradas_diario_agradecimiento.php");
        exit;
    } 



}


?>