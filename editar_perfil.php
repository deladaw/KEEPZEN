<?php
$titulo = "KeepZen - Editar Perfil";
include("./Controller/editar_datos.php");
include("./Controller/seguridad.php");
include("nav.php");

$id = $_REQUEST["id"];
    $consulta= $conexion->prepare("SELECT * from usuarios WHERE id = ?");
    $consulta->execute([$id]);
    $usuario = $consulta->fetch(PDO::FETCH_OBJ);

?>

?>

<!-- REGISTRO -->
<section class="registro container">
    <h2 class="registro__title heading-secondary">
        Editar datos personales
    </h2>
    <form action="" class="form" method="POST">
        <img class="band" src="img/generales/band_aid.svg" alt="">
        <div class="form__join">
            <div class="form__join-col col1">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $usuario->email; ?>"
                    pattern="[^@\s]+@[^@\s]+\.[^@\s]+" />
            </div>
            <div class="form__join-col">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $usuario->nombre; ?>" />
            </div>
        </div>
        <div class="form__join">
            <p class="error-msg"><?php if(isset($err_email)){echo $err_email; }?></p>
            <p class="error-msg"><?php if(isset($err_email2)){echo $err_email2; }?></p>
            <p class="error-msg"><?php if(isset($err_email3)){echo $err_email3; }?></p>
            <p class="error-msg"><?php if(isset($err_email4)){echo $err_email4; }?></p>
            <p class="error-msg"><?php if(isset($err_nom)){echo $err_nom; }?></p>
        </div>
        </div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password"
            value="<?php if(isset($_POST['password'])){echo$_POST['password'];} ?>" />
        <label for="password2">Repite contraseña</label>
        <input type="password" name="password2" id="password2"
        value="<?php echo $usuario->nombre; ?>" />
        <div>
            <p class="error-msg"><?php if(isset($err_pass)){echo $err_pass; }?></p>
            <p class="error-msg"><?php if(isset($err_pass2)){echo $err_pass2; }?></p>
            <p class="error-msg"><?php if(isset($err_pass3)){echo $err_pass3; }?></p>
            <p class="error-msg"><?php if(isset($err_pass4)){echo $err_pass4; }?></p>
        </div>
        <input type="submit" name="editar" id="editar" value="EDITAR" class="btn">
    </form>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>