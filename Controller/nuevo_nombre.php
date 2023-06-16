<?php
// Código para cambiar el nombre del usuario
include("conectar_db.php");
include("seguridad.php");

if (isset($_POST["enviar"])) {
    $nombre = $_POST["nombre"];
    $id_usuario = $_SESSION['id_usuario'];

    if (empty($nombre)) {
        $err_name = "* Por favor, ingresa un nuevo nombre.";
    } elseif (strlen($nombre) > 80) {

        $err_name = "* El nombre no puede tener más de 80 caracteres.";
    } else {

        if (!preg_match("/^[a-zA-Z ]*$/", $nombre)) {
            $err_name = "* El nombre solo puede contener letras y espacios.";
        } else {

            $update_query = "UPDATE usuarios SET nombre = :nombre WHERE id = :id_usuario";
            $update_stmt = $conexion->prepare($update_query);
            $update_stmt->bindParam(':nombre', $nombre);
            $update_stmt->bindParam(':id_usuario', $id_usuario);
            $update_stmt->execute();

            if ($update_stmt->rowCount() > 0) {

                $success = "¡Nombre actualizado exitosamente!";
            } else {
                
                $error = "* Error al actualizar el nombre. Por favor, intenta nuevamente.";
            }
        }
    }
}

?>