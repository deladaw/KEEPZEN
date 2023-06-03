<?php
include("../Model/conectar_db.php");
include("seguridad.php");

$id_entrada = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];

$sql = "DELETE FROM agradecimientos WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_entrada, $id_usuario]);

header("Location: ../entradas_diario_agradecimiento.php");
exit;
?>