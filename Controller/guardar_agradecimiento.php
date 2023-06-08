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

// Si se ha enviado el formulario
if (isset($_POST['enviaragradecimiento'])) {

    // Recuperamos los datos enviados
    $agradecimiento = htmlspecialchars($_POST["agradecimiento"], ENT_QUOTES, 'UTF-8');
    $id_usuario = $_SESSION['id_usuario'];

    // Validamos los datos
    $errores = 0;

    if (empty($agradecimiento)) {
        $err_vacio = "* No has escrito ningún agradecimiento";
        $errores = "1";
    }

    if (strlen($agradecimiento) > 3000) {
        $agradecimiento = substr($agradecimiento, 0, 3000);
        $err_textLG= "* Texto demasiado largo. El máximo permitido es de 2000 caracteres.";
        $errores = "1";
    }

    // Si no hay errores, insertamos el agradecimiento en la base de datos
    if ($errores != 1) {
        $sql = $conexion->prepare("INSERT INTO agradecimientos(id_usuario, agradecimiento) VALUES(?, ?)");
        $res = $sql->execute([$id_usuario, $agradecimiento]);

        if ($res) {
            // Redirigimos a la página del diario de agradecimiento
            header("Location: entradas_diario_agradecimiento.php");
            exit();
        } else {
            die("Error al guardar el agradecimiento.");
        }
    }
}
?>