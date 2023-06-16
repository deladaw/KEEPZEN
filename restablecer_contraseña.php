<?php
//Página para cambiar la contraseña del usuario desde el perfil personal
$titulo = "KeepZen - Restablecer contraseña";
include("./Controller/seguridad.php");
include("./Controller/restablecer_pass.php");
include("nav.php");

?>


<section class="login container pass">
    <h2 class="login__title heading-secondary">
        Restablecer contraseña
    </h2>
    <form class="form" action="" method="POST">
        <?php
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $token = isset($_GET['token']) ? $_GET['token'] : '';
        ?>
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <label for="password"><i class="fas fa-lock"></i> Nueva contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="confirm_password"><i class="fas fa-lock"></i> Confirmar contraseña:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <p class="error-msg"><?php if(isset($err_pass1)){echo $err_pass1; }?></p>
        <p class="error-msg"><?php if(isset($err_pass2)){echo $err_pass2; }?></p>
        <br>
        <input class="btn" type="submit" value="Restablecer contraseña">
    </form>
</section>


<?php
include("footer.php");
?>