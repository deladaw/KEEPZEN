<?php
include("conectar_db.php");
include("seguridad.php");
// Conexión a la base de datos
$conexion;
// Recibir el identificador único de la tarea a eliminar
$id_tarea = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];


// Eliminar la tarea correspondiente de la base de datos
$sql = "DELETE FROM tareas WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_tarea, $id_usuario]);

// Redirigir al usuario de vuelta a la página de tareas
if($stmt){

    header('Location: ../diario.php');

}