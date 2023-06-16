<?php
//Formulario para cambiar el email en el perfil personal del usuario.
$titulo = "KeepZen - Cambiar Email";
include("./Controller/seguridad.php");
include("./Controller/nuevo_email.php");
include("nav.php");

$id_usuario = $_SESSION['id_usuario'];

$usuario = getUsuario($conexion, $id_usuario)[0];
    $emailUsuario = $usuario->email;

?>

<section class="login container pass">
    <h2 class="login__title heading-secondary">
        Cambiar email
    </h2>
    <form action="" class="form" method="POST">

        <div class="form__join-col col1">
            <label for="email"><i class="fas fa-envelope"></i> Nuevo email</label>
            <input type="text" name="email" value="<?php echo $emailUsuario; ?>" />
        </div>

        <?php if(isset($err_email1)): ?>
        <p class="error-msg"><?php echo $err_email1; ?></p>
        <?php endif; ?>
        <?php if(isset($err_email2)): ?>
        <p class="error-msg"><?php echo $err_email2; ?></p>
        <?php endif; ?>
        <?php if(isset($err_email3)): ?>
        <p class="error-msg"><?php echo $err_email3; ?></p>
        <?php endif; ?>
        <?php if(isset($success)): ?>
        <p class="success-msg"><?php echo $success; ?></p>
        <?php endif; ?>
        <input type="submit" value="Cambiar email" name="enviar" class="btn submit">
    </form>
    <a href="gestionar_perfil.php" class="btn--secondary"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
</section>

<?php
include("footer.php");
?>