<?php
// Código para manejar el cambio de contraseña del usuario en el perfil personal.
include("conectar_db.php");
include("seguridad.php");

if (isset($_POST["enviar"])) {
    
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwd2 = $_POST["password2"];
    $id_usuario = $_SESSION['id_usuario'];

    if (empty($email) || empty($pwd) || empty($pwd2)) {
        $error = "* Por favor, completa todos los campos.";
    } elseif ($pwd != $pwd2) {
        $error = "* Las contraseñas no coinciden. Por favor, inténtalo nuevamente.";
    } elseif (strlen($pwd) < 6 || !preg_match("/\d/", $pwd)) {
        $error = "* La contraseña debe tener al menos 6 caracteres y contener al menos un número.";
    } else {
        // Validación adicional para evitar inserción de código malicioso en el email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "* El formato del email es inválido.";
        } else {
            $query = "SELECT * FROM usuarios WHERE id = :id_usuario AND email = :email";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_OBJ);

            if ($datos) {
                if ($email == $_SESSION['email']) {
                    $hash_password = password_hash($pwd, PASSWORD_DEFAULT);

                    $update_query = "UPDATE usuarios SET clave = :hash_password WHERE id = :id_usuario";
                    $update_stmt = $conexion->prepare($update_query);
                    $update_stmt->bindParam(':hash_password', $hash_password);
                    $update_stmt->bindParam(':id_usuario', $id_usuario);
                    $update_stmt->execute();

                    if ($update_stmt->rowCount() > 0) {
                        $success = "¡Contraseña actualizada exitosamente!";
                    } else {
                        $error = "* Error al actualizar la contraseña. Por favor, intenta nuevamente.";
                    }
                } else {
                    $error = "* El email no coincide con tu email. Verifica la dirección de correo electrónico.";
                }
            } else {
                $error = "* El usuario no existe o no coincide con el ID proporcionado. Verifica la dirección de correo electrónico.";
            }
        }
    }
}
?>