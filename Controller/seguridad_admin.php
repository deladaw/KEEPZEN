<?php

//Función para verificar si el usuario ha comprado un tema.
function verificar_compra_temas($id_usuario) {
  include("conectar_db.php");

  $sql = "SELECT tema_comprado FROM usuarios WHERE id = :id_usuario";
  $stmt = $conexion->prepare($sql);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();

  $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($resultado && $resultado['tema_comprado'] == 1) {
      return true; 
  } else {
      return false; 
  }
}

//Función para verificar si el usuario es admin.
function verificar_permisos_admin() {
  
  if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    
           ?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php
    exit();
  }
}


//Función para verificar si el usuario es un usuario normal.
function verificar_permisos_sesion() {
  
  if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {

           ?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php
    exit();
  }
}

//Función para verificar si el usuario es un usuario normal y/o un admin.
function verificar_permisos() {
  
  if (!isset($_SESSION['rol']) || ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2)) {
    ?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php
    exit();
  }
}

?>