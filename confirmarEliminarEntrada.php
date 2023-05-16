<?php
$titulo = "KeepZen - Diario";
include("./Model/conectar_db.php");
include("nav.php");
?>
<section class="confrimar-eliminar">
    <div class="eliminar container">
        <?php

        if (isset($_GET["id"])) {

            $id_entrada = $_GET["id"];
                 
        ?>
        <h3 class="heading-tertiary eliminar__title">¿Estás seguro de que quieres <span
                class="eliminar__highlight">eliminar</span> la
            entrada?
        </h3>

        <div class="eliminar__btns">
            <a class="btn--secondary" href="<?= $_SERVER["HTTP_REFERER"] ?>">Cancelar</a>
            <a class="btn" href="./Controller/eliminarEntrada.php?id=<?= $_GET["id"] ?>">Eliminar</a>
        </div>
        <?php
        }

        ?>
    </div>
</section>
<?php 
include 'footer.php';
?>