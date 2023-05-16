<?php
$titulo = "KeepZen - Diario";
include("./Model/conectar_db.php");
include("nav.php");
?>

<section class="confrimar-eliminar">
    <div class="eliminar container">
        <?php

        if (isset($_GET["id"])) {
            if($_SESSION['id_usuario'] == $_GET["id"]){     
        ?>
        <h3 class="heading-tertiary eliminar__title">¿Estás seguro de que quieres <span
                class="eliminar__highlight">desactivar</span> tu cuenta?
        </h3>


        <?php
    }else{
        ?>
        <h2>¿Estás seguro de que quieres <span class="rojo">DESACTIVAR</span> la cuenta del usuario
            <?php echo $_GET["id"] . '?' ?>
        </h2>
        <?php
    }
    ?>
        <div class="eliminar__btns">
            <a class="btn--secondary" href="<?= $_SERVER["HTTP_REFERER"] ?>">Cancelar</a>
            <a class="btn" href="./Controller/desactivarCuenta.php?id=<?= $_GET["id"] ?>">Desactivar</a>
        </div>
        <?php
        }

        ?>
    </div>
</section>

<?php 

include 'footer.php';

?>