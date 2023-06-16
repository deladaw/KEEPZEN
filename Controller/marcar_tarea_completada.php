<?php
include("conectar_db.php");

$conexion;

$id_tarea = $_GET['id'];

$stmt = $conexion->prepare('SELECT * FROM tareas WHERE id = ?');
$stmt->execute([$id_tarea]);
$tarea = $stmt->fetch(PDO::FETCH_OBJ);

$fecha_completada = ($_GET['completada'] == 'true') ? date('Y-m-d H:i:s') : NULL;
$stmt = $conexion->prepare('UPDATE tareas SET fecha_completada = ? WHERE id = ?');
$stmt->execute([$fecha_completada, $id_tarea]);

echo "La tarea con ID $id_tarea ha sido marcada como " . ($_GET['completada'] == 'true' ? 'completada' : 'no completada');
?>