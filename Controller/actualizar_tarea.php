<?php
include("../Model/conectar_db.php");
include("seguridad.php");

// Comprobamos que el usuario tenga una sesión iniciada
if (!isset($_SESSION['autentificado'])) {
    die("Error: usuario no autenticado.");
}

// Si se ha enviado el formulario
if (isset($_REQUEST['id'])) {
    // Recuperamos el ID de la tarea
    $id = $_REQUEST['id'];
    echo "Estoy dentro del POST";

    /// Crear una nueva fecha para el día de hoy a las 00:00:00
    $fecha_nueva = new DateTime();
    $fecha_nueva->setTime(0, 0, 0);

    // Formatear la nueva fecha como una cadena en formato 'Y-m-d H:i:s'
    $fecha_nueva_str = $fecha_nueva->format('Y-m-d H:i:s');

    // Actualizar la fecha de la tarea en la base de datos con la nueva fecha formateada
    $sql = $conexion->prepare("UPDATE tareas SET fecha_creacion = ? WHERE id = ?");
    $res = $sql->execute([$fecha_nueva_str, $id]);

    if ($res) {
        header('Location: ../diario_ayer.php');
        echo "Ha funcionado la inserción";
    } else {
        echo "Error al actualizar la tarea";
    }
}