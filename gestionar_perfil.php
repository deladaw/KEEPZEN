<?php
//Página para gestionar los datos del usuario (nombre, email, contraseña...)
$titulo = "KeepZen - Mis datos personales";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("./Controller/guardar_agradecimiento.php");
include("nav.php");

verificar_permisos();

if(isset($_SESSION['nombre_usuario'])){
    $nombreusuario = $_SESSION['nombre_usuario'];
    $id = $_SESSION['id_usuario'];
}
?>

<section class="profile container">
    <img src="img/generales/sloth_profile.svg" alt="animal perezoso durmiendo" class="sloth">
    <h2 class="profile__title heading-secondary">
        Gestionar mis datos
    </h2>
    <div class="profile__header">
        <div class="profile__options">
            <a href="nueva_contraseña.php" class="option-card">
                <i class="fas fa-key"></i>
                <p>Cambiar contraseña</p>
            </a>
            <a href="confirmarDesactivar.php?id=<?=$id?>" class="option-card">
                <i class="fas fa-user-times"></i>
                <p>Desactivar cuenta</p>
            </a>
            <a href="cambiar_nombre.php" class="option-card">
                <i class="fas fa-pen"></i>
                <p>Cambiar nombre</p>
            </a>
            <a href="cambiar_email.php" class="option-card">
                <i class="fas fa-envelope"></i>
                <p>Cambiar e-mail</p>
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>