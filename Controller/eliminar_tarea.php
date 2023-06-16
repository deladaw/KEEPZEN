<?php
//Código para eliminar una tarea de la Agenda.
include("conectar_db.php");
include("seguridad.php");

$conexion;

$id_tarea = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];

$sql = "DELETE FROM tareas WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_tarea, $id_usuario]);

if($stmt){

    header('Location: ../diario.php');

}