<?php
// Código para cambiar el email del usuario
include("conectar_db.php");
include("seguridad.php");

if (isset($_POST["enviar"])) {
    $email = $_POST["email"];
    $id_usuario = $_SESSION['id_usuario'];

    if (empty($email)) {
        $err_email1 = "* Por favor, ingresa un nuevo email.";
    } elseif (strlen($email) > 80) {

        $err_email2 = "* El email no puede tener más de 80 caracteres.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $err_email3 = "* Por favor, ingresa un email válido.";
    } else {

        $update_query = "UPDATE usuarios SET email = :email WHERE id = :id_usuario";
        $update_stmt = $conexion->prepare($update_query);
        $update_stmt->bindParam(':email', $email);
        $update_stmt->bindParam(':id_usuario', $id_usuario);
        $update_stmt->execute();

        if ($update_stmt->rowCount() > 0) {

            $success = "¡Email actualizado correctamente!";
        } else {

            $error = "* Error al actualizar el email. Por favor, intenta nuevamente.";
        }
    }
}

?>