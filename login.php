<?php
$titulo = "KeepZen - Iniciar Sesión";
include("./Controller/seguridad.php");
include("nav.php");
?>



<section class="login container">
    <h2 class="login__title heading-secondary">
        Inicia sesión
    </h2>
    <form action="" class="form">
        <img class="sun" src="img/login/login_sun.svg" alt="">

        <div class="form__join-col col1">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" />
        </div>
        </div>
        <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
        <input type="password" name="password" />
        <?php if(isset($error_pass)): ?>
        <p><?php echo $error_pass; ?></p>
        <?php endif; ?>
        <p class="forgot-pass"><a href="">¿Has olvidado la contraseña?</a></p>
    </form>
    <a class="btn" href="cuenta_creada.html">Iniciar sesión</a>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>