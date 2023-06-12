<?php
include("conectar_db.php");
include("seguridad.php");

// Comprobamos que el usuario tenga una sesión iniciada
if (!isset($_SESSION['autentificado'])) {
    // Devolver una respuesta de error
    echo 'error';
    exit;
}

if (isset($_GET['id'])) {
    // Recuperamos el ID de la tarea
    $id = $_GET['id'];
    $id_usuario = $_SESSION['id_usuario'];

    /// Crear una nueva fecha para el día de hoy a las 00:00:00
    $fecha_nueva = new DateTime();
    $fecha_nueva->setTime(0, 0, 0);

    // Formatear la nueva fecha como una cadena en formato 'Y-m-d H:i:s'
    $fecha_nueva_str = $fecha_nueva->format('Y-m-d H:i:s');

    // Actualizar la fecha de la tarea en la base de datos con la nueva fecha formateada
    $sql = $conexion->prepare("UPDATE tareas SET fecha_creacion = ? WHERE id = ? AND id_usuario = ?");
    $res = $sql->execute([$fecha_nueva_str, $id, $id_usuario]);

    if ($res) {
        // Devolver una respuesta exitosa
        header('Location: ../diario_ayer.php');
        exit;
    } else {
        // Devolver una respuesta de error
        header('Location: ../diario_ayer.php');
        exit;
    }
}

// Devolver una respuesta de error si no se proporciona un ID de tarea
echo 'error';
exit;
?>