<?php
//Código para obtener los datos de un usuario.
include 'seguridad.php';
include("conectar_db.php");

function getUsuario($conexion, $usuarioId) {
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuarioId]);
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}


?>