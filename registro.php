<?php
$titulo = "KeepZen - Diario";
include("./Controller/seguridad.php");
include("nav.php");
?>

<!-- REGISTRO -->
<section class="registro container">
    <h2 class="registro__title heading-secondary">
        ¡Crea una cuenta en pocos minutos!
    </h2>
    <h4>¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a> </h4>
    <form action="" class="form">
        <img class="band" src="img/generales/band_aid.svg" alt="">
        <div class="form__join">
            <div class="form__join-col col1">
                <label for="email">Email</label>
                <input type="email" name="email" />
            </div>
            <div class="form__join-col">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
            </div>
        </div>
        </div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" />
        <label for="password2">Repite contraseña</label>
        <input type="password" name="password2" />
        <label><input type="checkbox" id="policy" value="policy" /> Acepto la
            política de privacidad y términos de uso</label><br />
        <?php if(isset($error_pass)): ?>
        <p><?php echo $error_pass; ?></p>
        <?php endif; ?>
    </form>
    <a class="btn" href="cuenta_creada.php">CREAR CUENTA</a>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>