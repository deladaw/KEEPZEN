<?php
$titulo = "KeepZen - Login";
include("./Controller/seguridad.php"); // Verifica si el usuario está autenticado
include("./Controller/loginController.php"); // Verifica si el usuario está autenticado
include("nav.php");
?>

<section class="login container">
    <h2 class="login__title heading-secondary">
        Iniciar sesión
    </h2>
    <h4>¿No tienes una cuenta? <a href="registro.php">Regístrate</a> </h4>
    <form action="" class="form" method="POST">
        <img class="sun" src="img/login/login_sun.svg" alt="">

        <div class="form__join-col col1">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo$_POST['email'];} ?>" />
        </div>
        </div>
        <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
        <input type="password" name="password"
            value="<?php if(isset($_POST['password'])){echo$_POST['password'];} ?>" />
        <?php if(isset($error_pass)): ?>
        <p class="error-msg"><?php echo $error_pass; ?></p>
        <?php endif; ?>
        <?php if(isset($error_login)): ?>
        <p class="error-msg"><?php echo $error_login; ?></p>
        <?php endif; ?>
        <p class="forgot-pass"><a href="recuperar_contraseña.php">¿Has olvidado la contraseña?</a></p>
        <input type="submit" value="Iniciar Sesión" name="enviar" class="btn">
    </form>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>