<?php
// Código del Login de los usuarios
include("conectar_db.php");

if (isset($_POST["enviar"])) {
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwd2 = $_POST["password2"];

    // Validar que no haya campos vacíos
    if (empty($email) || empty($pwd) || empty($pwd2)) {
        $error = "* Por favor, completa todos los campos.";
    } elseif ($pwd != $pwd2) {
        $error = "* Las contraseñas no coinciden. Por favor, inténtalo nuevamente.";
    } else {
        // Comprobación de los DATOS de LOGIN AND activo = 1
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$email]);
        $datos = $stmt->fetch(PDO::FETCH_OBJ);

        if ($datos) {
            // Usuario encontrado, actualizar la contraseña
            $hash_password = password_hash($pwd, PASSWORD_DEFAULT);

            $update_query = "UPDATE usuarios SET clave = ? WHERE email = ?";
            $update_stmt = $conexion->prepare($update_query);
            $update_stmt->execute([$hash_password, $email]);

            // Verificar si se realizó la actualización correctamente
            if ($update_stmt->rowCount() > 0) {
                // Contraseña actualizada exitosamente, redirigir o mostrar un mensaje de éxito
                $success = "¡Contraseña actualizada exitosamente!";
            } else {
                // Ocurrió un error al actualizar la contraseña, mostrar un mensaje de error
                $error = "* Error al actualizar la contraseña. Por favor, intenta nuevamente.";
            }
        } else {
            // El usuario no existe, mostrar un mensaje de error
            $error = "* El usuario no existe. Verifica la dirección de correo electrónico.";
        }
    }
}
?>