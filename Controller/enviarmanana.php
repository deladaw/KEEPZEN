<?php
include("conectar_db.php");

// Comprobamos que el usuario tenga una sesión iniciada
if (!isset($_SESSION['id_usuario'])) {
    ?>
<script>
window.location.href = "../index.php";
</script>

<?php
}

// Si se ha enviado el formulario
if (isset($_POST['enviarmanana'])) {

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
        // Obtenemos la fecha de mañana
        $fecha_creacion = new DateTime('tomorrow');
        $fecha_creacion_str = $fecha_creacion->format('Y-m-d');

        // Insertamos la tarea en la base de datos
        $sql = $conexion->prepare("INSERT INTO tareas(id_usuario, tarea, fecha_creacion) VALUES(?, ?, ?)");
        $res = $sql->execute([$id_usuario, $tarea, $fecha_creacion_str]);

        if ($res) {
            // Redirigimos a la página de diario de mañana
            header("Location: diario_manana.php");
            exit();
        } else {
            die("Error al guardar la tarea.");
        }
    }
}
    
?>