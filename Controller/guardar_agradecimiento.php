<?php
//Código para guardar una entrada de  agradecmiento.
include 'seguridad.php';
include("conectar_db.php");

if (!isset($_SESSION['id_usuario'])) {
    ?>
<script>
window.location.href = "index.php";
</script>

<?php
}

if (isset($_POST['enviaragradecimiento'])) {

    $agradecimiento = htmlspecialchars($_POST["agradecimiento"], ENT_QUOTES, 'UTF-8');
    $id_usuario = $_SESSION['id_usuario'];

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

    if ($errores != 1) {
        $sql = $conexion->prepare("INSERT INTO agradecimientos(id_usuario, agradecimiento) VALUES(?, ?)");
        $res = $sql->execute([$id_usuario, $agradecimiento]);

        if ($res) {

            header("Location: entradas_diario_agradecimiento.php");
            exit();
        } else {
            die("Error al guardar el agradecimiento.");
        }
    }
}
?>