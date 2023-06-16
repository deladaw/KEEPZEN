<?php
//Código para agregar una tarea en la vista "mañana" de la agenda.
include("conectar_db.php");
include("seguridad.php");


if (!isset($_SESSION['id_usuario'])) {
    ?>
<script>
window.location.href = "index.php";
</script>

<?php
}


if (isset($_POST['tarea_manana'])) {

    $tarea = htmlspecialchars($_POST["tarea_manana"], ENT_QUOTES, 'UTF-8');
    $id_usuario = $_SESSION['id_usuario'];

    $errores = 0;

    echo $errores;

    if (empty($tarea)) {
        $errores = "1";
    }

    if ($errores != 1) {

        $fecha_creacion = new DateTime('tomorrow');
        $fecha_creacion_str = $fecha_creacion->format('Y-m-d');

        $sql = $conexion->prepare("INSERT INTO tareas(id_usuario, tarea, fecha_creacion) VALUES(?, ?, ?)");
        $res = $sql->execute([$id_usuario, $tarea, $fecha_creacion_str]);

        if ($res) {
            header("Location: ../diario_manana.php");
            exit();
        } else {
            die("Error al guardar la tarea.");
        }
    }
}
    
?>