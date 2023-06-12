<?php
include 'seguridad.php';
include("conectar_db.php");

if (isset($_REQUEST['canjear'])) {
    $cupon = $_REQUEST['cupon'];
    $id_usuario = $_SESSION['id_usuario'];


    if ($cupon === 'DBS') {
        // Actualizar el campo "tema_comprado" a 1 en la tabla "usuarios" para el usuario actual
        $sql = "UPDATE usuarios SET tema_comprado = 1 WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_usuario]);

        // Verificar si se realizó la actualización correctamente
        if ($stmt->rowCount() > 0) {
            header('Location: temas.php');
        } else {
            $err_cupon = '* Cupón no válido.';
        }
    }else{
        $err_cupon = '* Cupón no válido.';
    }
}
?>