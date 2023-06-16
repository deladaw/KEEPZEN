<?php
//Código para mover una tarea del día de ayer al día de hoy.
include("conectar_db.php");
include("seguridad.php");

if (!isset($_SESSION['autentificado'])) {

    echo 'error';
    exit;
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id_usuario = $_SESSION['id_usuario'];


    $fecha_nueva = new DateTime();
    $fecha_nueva->setTime(0, 0, 0);

    $fecha_nueva_str = $fecha_nueva->format('Y-m-d H:i:s');

    $sql = $conexion->prepare("UPDATE tareas SET fecha_creacion = ? WHERE id = ? AND id_usuario = ?");
    $res = $sql->execute([$fecha_nueva_str, $id, $id_usuario]);

    if ($res) {
        
        header('Location: ../diario_ayer.php');
        exit;
    } else {
        
        header('Location: ../diario_ayer.php');
        exit;
    }
}

echo 'error';
exit;
?>