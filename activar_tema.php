<?php
$titulo = "KeepZen - Activar Tema";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("./Controller/conectar_db.php");
include("nav.php");
?>

<div class="theme-selection container">
    <h2 class="heading-secondary">Selecciona un tema <i class="fas fa-paint-brush"></i></h2>
    <div class="theme-selection__btns">

        <a class="btn" href="./Controller/cambiarTema.php?tema=1" id="coral-blush">Coral Blush</a>
        <a class="btn" href="./Controller/cambiarTema.php?tema=2" id="dark-chocolate">Dark Choco</a>
        <a class="btn" href="./Controller/cambiarTema.php?tema=3" id="lemon-pie">Lemon Pie</a>
        <a class="btn" href="./Controller/cambiarTema.php?tema=4" id="lemon-pie">Dracula</a>
    </div>
</div>


<?php
include("footer.php");
?>