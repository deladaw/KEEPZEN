<?php
//Código para marcar la tarea como favorita.
include("conectar_db.php");

$conexion;

$id_tarea = $_GET['id'];


$stmt = $conexion->prepare('SELECT * FROM tareas WHERE id = ?');
$stmt->execute([$id_tarea]);
$tarea = $stmt->fetch(PDO::FETCH_OBJ);


if ($tarea->favorita) {
  
  $stmt = $conexion->prepare('UPDATE tareas SET favorita = 0, fecha_creacion = CURRENT_TIMESTAMP WHERE id = ?');
} else {
  
  $stmt = $conexion->prepare('UPDATE tareas SET favorita = 1, fecha_creacion = CURRENT_TIMESTAMP WHERE id = ?');
}
$stmt->execute([$id_tarea]);


header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>