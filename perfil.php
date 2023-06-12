<?php
$titulo = "KeepZen - Perfil";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("./Controller/guardar_agradecimiento.php");
include("nav.php");

verificar_permisos_sesion();

if(isset($_SESSION['nombre_usuario'])){
    $nombreusuario = $_SESSION['nombre_usuario'];
    $id = $_SESSION['id_usuario'];
}
?>

<section class="profile container">
    <!-- <img src="img/generales/sloth_profile.svg" alt="animal perezoso durmiendo" class="sloth"> -->
    <h2 class="profile__title heading-secondary">
        Bienvenido/a <?php echo $nombreusuario ?>, estás en tu perfil personal
    </h2>
    <div class="profile__header">
        <div class="profile__options">
            <a href="entradas_diario_agradecimiento.php" class="option-card">
                <i class="fas fa-book"></i>
                <p>Tu diario de gratitud</p>
            </a>
            <!-- <a href="working_on.php" class="option-card">
                <i class="fas fa-user-edit"></i>
                <p>Editar datos personales</p>
            </a> -->
            <a href="confirmarDesactivar.php?id=<?=$id?>" class="option-card">
                <i class="fas fa-user-times"></i>
                <p>Desactivar cuenta</p>
            </a>

            <a href="comprar_tema.php" class="option-card">
                <i class="fas fa-palette"></i>
                <p>Cambiar tema interfaz</p>
            </a>
            <a href="./Controller/salir.php" class="option-card">
                <i class="fas fa-times-circle"></i>
                <p>Cerrar sesión</p>
            </a>
        </div>
    </div>

    <!-- DIARIO AGRADECIMIENTO -->
    <div class="greet">
        <h3 class="heading-tertiary greet__title">¿Por qué te sientes agradecido/a hoy? <i
                class="fas fa-pencil-alt"></i></h3>
        <form action="" method="POST">
            <textarea maxlength="2990"
                placeholder="Por ej: Tener una mascota que te quiere, tomar un café en un día soleado, tener la oportunidad de aprender cosas nuevas cada día..."
                class="entry" name="agradecimiento" id="" cols="85" rows="6"></textarea>
            <div>
                <p class="error-msg"><?php if(isset($err_vacio)){echo $err_vacio; }?></p>
                <p class="error-msg"><?php if(isset($err_textLG)){echo $err_textLG; }?></p>
            </div>
            <input type="submit" value="ANOTAR" name="enviaragradecimiento" class="btn add-entry">
        </form>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>