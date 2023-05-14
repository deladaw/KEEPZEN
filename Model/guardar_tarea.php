<?php
include("conectar_db.php");

// Comprobamos que el usuario tenga una sesión iniciada
if (!isset($_SESSION['id_usuario'])) {
    die("Error: usuario no autenticado.");
}

// Si se ha enviado el formulario
if (isset($_POST['enviartarea'])) {

    // Recuperamos los datos enviados
    $tarea = htmlspecialchars($_POST["tarea"], ENT_QUOTES, 'UTF-8');
    $id_usuario = $_SESSION['id_usuario'];

    // Validamos los datos
    $errores = 0;

    if (empty($tarea)) {
        $errores = "1";
    }
    // Si no hay errores, insertamos la tarea en la base de datos
    if ($errores != 1) {
        echo $errores;
        $sql = $conexion->prepare("INSERT INTO tareas(id_usuario, tarea) VALUES(?, ?)");
        $res = $sql->execute([$id_usuario, $tarea]);

        if ($res) {
            // Redirigimos a la página de diario
            header("Location: diario.php");
            exit();
        } else {
            die("Error al guardar la tarea.");
        }
    }
}
    
?>