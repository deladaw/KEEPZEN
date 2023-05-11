<?php

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

?>