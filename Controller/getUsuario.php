<?php
include 'seguridad.php';
include("./Model/conectar_db.php");

function getUsuario($conexion, $usuarioId) {
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuarioId]);
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}


?>