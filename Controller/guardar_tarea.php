<?php
//Código para guardar una tarea en el día de hoy.
include 'seguridad.php';
include("conectar_db.php");

if (!isset($_SESSION['id_usuario'])) {
    ?>
<script>
window.location.href = "index.php";
</script>

<?php
}

if (isset($_POST['tarea'])) {

    $tarea = htmlspecialchars($_POST["tarea"], ENT_QUOTES, 'UTF-8');
    $id_usuario = $_SESSION['id_usuario'];

    $tarea = trim($tarea);

    $errores = 0;

    if (empty($tarea)) {
        $errores = 1;
    }

    if ($errores != 1) {
        $sql = $conexion->prepare("INSERT INTO tareas(id_usuario, tarea) VALUES (?, ?)");
        $res = $sql->execute([$id_usuario, $tarea]);

        if ($res) {

            http_response_code(200);
            header("Location: ../diario.php");
              
        }   
    }else{
        header("Location: ../diario.php");
    }
}

?>