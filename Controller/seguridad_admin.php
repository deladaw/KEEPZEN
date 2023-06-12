<?php
function verificar_compra_temas($id_usuario) {
  include("conectar_db.php");

  // Preparar la consulta SQL
  $sql = "SELECT tema_comprado FROM usuarios WHERE id = :id_usuario";
  $stmt = $conexion->prepare($sql);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();

  // Obtener el resultado de la consulta
  $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($resultado && $resultado['tema_comprado'] == 1) {
      return true; // El usuario tiene el tema comprado
  } else {
      return false; // El usuario no tiene el tema comprado
  }
}

function verificar_permisos_admin() {
  // Verificar si el usuario actual tiene un rol de administrador
  if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    // Si el usuario no tiene el rol de administrador, redirigir a otra página
           ?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php
    exit();
  }
}
function verificar_permisos_sesion() {
  // Verificar si el usuario actual tiene un rol de usuario
  if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {

           ?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php
    exit();
  }
}

?>