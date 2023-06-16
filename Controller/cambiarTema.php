<?php
//Código para hacer un update del tema activo y cambiar la apariencia de la página.
include 'seguridad.php';
include("conectar_db.php");

$usuarioId = $_SESSION['id_usuario'];

if (isset($_GET['tema'])) {
    $temaActivoId = $_GET['tema'];

    try {
        
        $sql = "UPDATE usuarios SET tema_activo_id = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $temaActivoId, PDO::PARAM_INT);
        $stmt->bindParam(2, $usuarioId, PDO::PARAM_INT);
        $stmt->execute();

        
        header("Location: ../temas.php");
        exit();
    } catch (PDOException $e) {
        
        echo "Error al actualizar el tema activo: " . $e->getMessage();
    }
}


$conexion = null;
?>