<?php
$titulo = "KeepZen - Working On";
include("./Controller/seguridad.php");
include("./Controller/nueva_pass.php");
include("nav.php");

?>


<section class="login container">
    <h2 class="login__title heading-secondary">
        Recuperar contraseña
    </h2>
    <form action="" class="form" method="POST">

        <div class="form__join-col col1">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo$_POST['email'];} ?>" />
        </div>
        </div>
        <label for="password"><i class="fas fa-lock"></i> Nueva contraseña</label>
        <input type="password" name="password"
            value="<?php if(isset($_POST['password'])){echo$_POST['password'];} ?>" />
        <label for="password2"><i class="fas fa-lock"></i> Repite contraseña</label>
        <input type="password" name="password2"
            value="<?php if(isset($_POST['password'])){echo$_POST['password'];} ?>" />
        <?php if(isset($err_pass)): ?>
        <p class="error-msg"><?php echo $err_pass; ?></p>
        <?php endif; ?>
        <?php if(isset($err_email)): ?>
        <p class="error-msg"><?php echo $err_email; ?></p>
        <?php endif; ?>
        <?php if(isset($error)): ?>
        <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if(isset($success)): ?>
        <p class="success-msg"><?php echo $success; ?></p>
        <?php endif; ?>
        <input type="submit" value="Cambiar contraseña" name="enviar" class="btn">
    </form>
</section>


<?php
include("footer.php");
?>