<?php
include("conectar_db.php");

function limpiarEntrada($dato) {
    $dato = trim($dato); // Eliminar espacios en blanco antes y después de los datos
    $dato = stripslashes($dato); // Eliminar barras invertidas escapadas
    $dato = htmlspecialchars($dato); // Convertir caracteres especiales en entidades HTML
    return $dato;
}

if (isset($_REQUEST['crear'])) {
    $email = limpiarEntrada($_POST["email"]);
    $nombre = limpiarEntrada($_POST["nombre"]);
    $contrasena_nueva = limpiarEntrada($_POST["password"]);
    $contrasena_nueva2 = limpiarEntrada($_POST["password2"]);

    $errores = 0;

    if (isset($_POST["rol"])) {
        $rol = limpiarEntrada($_POST["rol"]);
    }

    $resultado = $conexion->prepare("SELECT * FROM usuarios");
    $resultado->execute();
    $datos = $resultado->fetchAll(PDO::FETCH_OBJ);

    // Validación de la política de privacidad
    if (!isset($_POST['policy']) || $_POST['policy'] == "") {
        $err_pol = "* Debes aceptar la política de privacidad";
        $errores = 1;
    }

    // Validación de la contraseña
    if (empty($contrasena_nueva)) {
        $err_pass = "* Contraseña no introducida";
        $errores = 1;
    } elseif (strlen($contrasena_nueva) > 255) {
        $err_pass2 = "* Contraseña demasiado larga (máx. 255 caracteres)";
        $errores = 1;
    }

    // Validación de la contraseña introducida nuevamente
    if (empty($contrasena_nueva2)) {
        $err_pass = "* Contraseña no introducida";
        $errores = 1;
    } elseif (strlen($contrasena_nueva) > 255) {
        $err_pass3 = "* Contraseña demasiado larga (máx. 255 caracteres)";
        $errores = 1;
    }

    if ($contrasena_nueva != $contrasena_nueva2) {
        $err_pass4 = "* Las contraseñas no coinciden.";
        $errores = 1;
    }

    // Validación del nombre
    if (empty($nombre)) {
        $err_nom = "* Nombre no introducido";
        $errores = 1;
    } elseif (strlen($nombre) > 255) {
        $err_nom2 = "* Nombre demasiado largo (máx. 255 caracteres)";
        $errores = 1;
    }

    // Validación del email
    if (empty($email)) {
        $err_email = "* Email no introducido";
        $errores = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores = 1;
        $err_email2 = '* Por favor, introduce un email válido.';
    } elseif (strlen($email) > 250) {
        $err_email3 = "* Por favor, introduce un email menor a 250 caracteres.";
        $errores = 1;
    }

    // Verificar si el email ya está en uso
    foreach ($datos as $res) {
        if ($email == $res->email) {
            $err_email4 = "* El e-mail ya se encuentra en uso.";
            $errores = 1;
        }
    }

    if (isset($_POST["rol"])) {
        // Selección del ROL
        switch ($rol) {
            case '1':
                $rol = 1;
                break;
            case '2':
                $rol = 2;
                break;
        }
    }

    // Cifrado de contraseña con método HASH
    $passHash = password_hash($contrasena_nueva, PASSWORD_DEFAULT);

    // Si no hay errores, se insertan los datos y se redirige al login
    if ($errores != 1) {
        // Si el usuario es admin (rol = 2), se añade y selecciona el rol del cliente
        if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2) {
            $sql = $conexion->prepare("INSERT INTO usuarios(email, nombre, clave, id_rol)  VALUES(?,?,?)");
            $res = $sql->execute([$email, $nombre, $passHash, $rol]);
        } else {
            $sql = $conexion->prepare("INSERT INTO usuarios(email, nombre, clave)  VALUES(?,?,?)");
            $res = $sql->execute([$email, $nombre, $passHash]);
        }

        // Redirigir a la página de cuenta creada
        if ($res) {
            $resultado = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? ");
            $resultado->execute([$email]);
            $datos = $resultado->fetch(PDO::FETCH_OBJ);

            session_status() === PHP_SESSION_ACTIVE ?: session_start();
            $_SESSION['email'] = $datos->email;
            $_SESSION['nombre_usuario'] = $datos->nombre;
            $_SESSION['id_usuario'] = $datos->id;
            $_SESSION['autentificado'] = true;
            $_SESSION['rol'] = $datos->id_rol;

            if ($datos) {
                ?><script>
location.replace("cuenta_creada.php");
</script><?php
            }
        }
    }
}
?>