<?php
//Página para confirmar que la cuenta ha sido creada correctamente.
$titulo = "KeepZen - Contraseña restablecida";
include("./Controller/seguridad.php");
include("nav.php");

?>

<!-- CUENTA CREADA -->
<section class="created container">
    <i class="fas fa-check-circle"></i>
    <h2 class="heading-secondary">¡Contraseña Restablecida!</h2>
    <p class="sub-heading">
        La contraseña se ha cambiado correctamente.
    </p>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>