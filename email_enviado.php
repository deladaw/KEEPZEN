<?php
//Página para confirmar que la cuenta ha sido creada correctamente.
$titulo = "KeepZen - Email enviado";
include("./Controller/seguridad.php");
include("nav.php");

?>

<!-- CUENTA CREADA -->
<section class="created container">
    <i class="fas fa-check-circle"></i>
    <h2 class="heading-secondary">¡Email enviado!</h2>
    <p class="sub-heading">
        Revisa tu bandeja de entrada. Te habrá llegado un correo para restablecer la contraseña.
    </p>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>