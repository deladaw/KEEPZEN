<?php
include("../Model/conectar_db.php");
// Conexión a la base de datos
$conexion;
// Recibir el identificador único de la tarea a eliminar
$id_tarea = $_GET['id'];

// Eliminar la tarea correspondiente de la base de datos
$sql = "DELETE FROM tareas WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_tarea]);

// Redirigir al usuario de vuelta a la página de tareas
if($stmt){

    header('Location: ../diario.php');

}