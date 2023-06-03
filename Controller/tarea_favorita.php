<?php
include("conectar_db.php");

$conexion;
// Obtener el id de la tarea a marcar como favorita
$id_tarea = $_GET['id'];

// Obtener la información de la tarea
$stmt = $conexion->prepare('SELECT * FROM tareas WHERE id = ?');
$stmt->execute([$id_tarea]);
$tarea = $stmt->fetch(PDO::FETCH_OBJ);

// Cambiar el valor de la propiedad 'favorita'
if ($tarea->favorita) {
  // Desmarcar como favorita y actualizar fecha_creacion
  $stmt = $conexion->prepare('UPDATE tareas SET favorita = 0, fecha_creacion = CURRENT_TIMESTAMP WHERE id = ?');
} else {
  // Marcar como favorita y actualizar fecha_creacion
  $stmt = $conexion->prepare('UPDATE tareas SET favorita = 1, fecha_creacion = CURRENT_TIMESTAMP WHERE id = ?');
}
$stmt->execute([$id_tarea]);

// Redirigir a la página anterior
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>