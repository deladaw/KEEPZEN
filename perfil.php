<?php
$titulo = "KeepZen - Perfil";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("nav.php");

verificar_permisos_sesion();

if(isset($_SESSION['nombre_usuario'])){
    $nombreusuario = $_SESSION['nombre_usuario'];
}
?>

<section class="profile container">
    <h2 class="login__title heading-secondary">
        Bienvenido/a <?php echo $nombreusuario ?>, estás en tu perfil personal
    </h2>


    <a class="btn" href="./Controller/salir.php">CERRAR SESIÓN ➡</a>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>