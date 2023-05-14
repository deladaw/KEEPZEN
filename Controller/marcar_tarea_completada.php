<?php
include("../Model/conectar_db.php");

$conexion;
// Obtener el id de la tarea a marcar como completada
$id_tarea = $_GET['id'];

// Obtener la información de la tarea
$stmt = $conexion->prepare('SELECT * FROM tareas WHERE id = ?');
$stmt->execute([$id_tarea]);
$tarea = $stmt->fetch(PDO::FETCH_OBJ);

// Cambiar el valor de la propiedad 'fecha_completada'
$fecha_completada = ($_GET['completada'] == 'true') ? date('Y-m-d H:i:s') : NULL;
$stmt = $conexion->prepare('UPDATE tareas SET fecha_completada = ? WHERE id = ?');
$stmt->execute([$fecha_completada, $id_tarea]);

// Retornar un mensaje de éxito
echo "La tarea con ID $id_tarea ha sido marcada como " . ($_GET['completada'] == 'true' ? 'completada' : 'no completada');
?>