<?php
//Página para confirmar la eliminación de una entrada de agradecimiento.
$titulo = "KeepZen - Confirmar eliminar";
include("./Controller/conectar_db.php");
include("nav.php");
?>
<section class="confrimar-eliminar">
    <div class="eliminar container">
        <?php
        if (isset($_GET["id"])) {

            $id_entrada = $_GET["id"];

            $id_usuario_sesion = $_SESSION["id_usuario"];

            $query = "SELECT * FROM agradecimientos WHERE id = ?";
            $stmt = $conexion->prepare($query);
            $stmt->execute([$id_entrada]);
            $entrada = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($entrada && $entrada["id_usuario"] == $id_usuario_sesion) {
                ?>
        <h3 class="heading-tertiary eliminar__title">¿Estás seguro de que quieres <span
                class="eliminar__highlight">eliminar</span> la entrada?</h3>

        <div class="eliminar__btns">
            <a class="btn--secondary" href="<?= $_SERVER["HTTP_REFERER"] ?>">Cancelar</a>
            <a class="btn" href="./Controller/eliminarEntrada.php?id=<?= $_GET["id"] ?>">Eliminar</a>
        </div>
        <?php
            } else {
                echo "No tienes permiso para eliminar esta entrada.";

            }
        } else {
            echo "No se ha especificado una entrada para eliminar.";
        }
        ?>
    </div>
</section>
<?php
include 'footer.php';
?>