<?php
//Página para recuperar la contraseña si no has iniciado sesión.
$titulo = "KeepZen - Recuperar Contraseña";
include("nav.php");

?>


<section class="login container pass">
    <h2 class="login__title heading-secondary">
        Recuperar contraseña
    </h2>

    <form action="./Controller/recuperar_pass.php" method="POST" class="form">
        <label for="email">Dirección de correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Recuperar Contraseña" name="enviar" class="btn">
    </form>
</section>


<?php
include("footer.php");
?>