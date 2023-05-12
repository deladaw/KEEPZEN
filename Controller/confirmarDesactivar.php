<?php 
// Página para preguntar si realmente quieres desactivar al usuario, antes de desactivarlo.

?>
<div class="eliminar">
    <?php

        if (isset($_GET["id"])) {
            if($_SESSION['usuario'] == $_GET["id"]){     
        ?>
    <h2>¿Estás seguro de que quieres <span class="rojo">DESACTIVAR</span> tu cuenta,
        <?php echo $_GET["id"] . '?' ?>
    </h2>
    <?php
    }else{
        ?>
    <h2>¿Estás seguro de que quieres <span class="rojo">DESACTIVAR</span> la cuenta del usuario
        <?php echo $_GET["id"] . '?' ?>
    </h2>
    <?php
    }
    ?>
    <div class="botones-eliminar">
        <a class="btn--secondary" href="<?= $_SERVER["HTTP_REFERER"] ?>">Cancelar</a>
        <br>
        <a class="btn" href="desactivarCuenta.php/?id=<?= $_GET["id"] ?>">Dar de baja</a>
    </div>
    <?php
        }

        ?>
</div>
<?php 

include 'aside-dcho.php';
include 'footer.php';

?>