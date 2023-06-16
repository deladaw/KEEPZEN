<?php
//Formulario para cambiar el nombre en el perfil personal del usuario.
$titulo = "KeepZen - Cambiar Nombre";
include("./Controller/seguridad.php");
include("./Controller/nuevo_nombre.php");
include("nav.php");

$id_usuario = $_SESSION['id_usuario'];

$usuario = getUsuario($conexion, $id_usuario)[0];
    $nombreUsuario = $usuario->nombre;

?>

<section class="login container pass">
    <h2 class="login__title heading-secondary">
        Cambiar nombre
    </h2>
    <form action="" class="form" method="POST">

        <div class="form__join-col col1">
            <label for="nombre"><i class="fas fa-user"></i> Nuevo nombre</label>
            <input type="text" name="nombre" value="<?php echo $nombreUsuario; ?>" />
        </div>

        <?php if(isset($err_name)): ?>
        <p class="error-msg"><?php echo $err_name; ?></p>
        <?php endif; ?>
        <?php if(isset($success)): ?>
        <p class="success-msg"><?php echo $success; ?></p>
        <?php endif; ?>
        <input type="submit" value="Cambiar nombre" name="enviar" class="btn submit">
    </form>
    <a href="gestionar_perfil.php" class="btn--secondary"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
</section>

<?php
include("footer.php");
?>