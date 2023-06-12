<?php
include 'seguridad.php';
include("conectar_db.php");

$usuarioId = $_SESSION['id_usuario'];

if (isset($_GET['tema'])) {
    $temaActivoId = $_GET['tema'];

    try {
        // Actualizar el valor del tema activo en la tabla de usuarios
        $sql = "UPDATE usuarios SET tema_activo_id = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $temaActivoId, PDO::PARAM_INT);
        $stmt->bindParam(2, $usuarioId, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir al usuario de regreso a la página principal u otra página según tu lógica
        header("Location: ../temas.php");
        exit();
    } catch (PDOException $e) {
        // Manejar el error, mostrar un mensaje de error al usuario o redirigir a una página de error
        echo "Error al actualizar el tema activo: " . $e->getMessage();
    }
}

// Cierra la conexión a la base de datos
$conexion = null;
?>