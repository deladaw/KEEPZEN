<?php
include("../Model/conectar_db.php");

$conexion;
// Obtener el id de la tarea a marcar como favorita
$id_tarea = $_GET['id'];

// Obtener la información de la tarea
$stmt = $conexion->prepare('SELECT * FROM tareas WHERE id = ?');
$stmt->execute([$id_tarea]);
$tarea = $stmt->fetch(PDO::FETCH_OBJ);

// Cambiar el valor de la propiedad 'favorita'
if ($tarea->favorita) {
  $stmt = $conexion->prepare('UPDATE tareas SET favorita = 0 WHERE id = ?');
} else {
  $stmt = $conexion->prepare('UPDATE tareas SET favorita = 1 WHERE id = ?');
}
$stmt->execute([$id_tarea]);

// Redirigir a la página anterior
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>