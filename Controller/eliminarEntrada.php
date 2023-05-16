<?php
include("../Model/conectar_db.php");

$id_entrada = $_GET['id'];

$sql = "DELETE FROM agradecimientos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_entrada]);

header("Location: ../entradas_diario_agradecimiento.php");
exit;
?>