<?php
include 'seguridad.php';
include("conectar_db.php");

// Comprobamos que el usuario tenga una sesión iniciada
if (!isset($_SESSION['id_usuario'])) {
    ?>
<script>
window.location.href = "index.php";
</script>

<?php
}

// Si se ha enviado la tarea
if (isset($_POST['tarea'])) {
    // Recuperamos la tarea enviada
    $tarea = htmlspecialchars($_POST["tarea"], ENT_QUOTES, 'UTF-8');
    $id_usuario = $_SESSION['id_usuario'];

    $tarea = trim($tarea);
    // Validamos los datos
    $errores = 0;

    if (empty($tarea)) {
        $errores = 1;
    }

    // Si no hay errores, insertamos la tarea en la base de datos
    if ($errores != 1) {
        $sql = $conexion->prepare("INSERT INTO tareas(id_usuario, tarea) VALUES (?, ?)");
        $res = $sql->execute([$id_usuario, $tarea]);

        if ($res) {
            // La tarea se agregó correctamente
            http_response_code(200);
            header("Location: ../diario.php");
              
        }   
    }else{
        header("Location: ../diario.php");
    }
}

?>