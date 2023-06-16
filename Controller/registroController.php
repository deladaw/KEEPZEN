<?php
//Código para el resgistro de un usuario. Te inicia sesión automáticamente al terminar.
include("conectar_db.php");

function limpiarEntrada($dato) {
    $dato = trim($dato); 
    $dato = stripslashes($dato); 
    $dato = htmlspecialchars($dato); 
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

    if (!isset($_POST['policy']) || $_POST['policy'] == "") {
        $err_pol = "* Debes aceptar la política de privacidad";
        $errores = 1;
    }

    if (empty($contrasena_nueva)) {
        $err_pass = "* Contraseña no introducida";
        $errores = 1;
    } elseif (strlen($contrasena_nueva) > 255) {
        $err_pass2 = "* Contraseña demasiado larga (máx. 255 caracteres)";
        $errores = 1;
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $contrasena_nueva)) {
        $err_pass2 = "* La contraseña debe tener al menos 6 caracteres y contener al menos un número";
        $errores = 1;
    }


    if (empty($contrasena_nueva2)) {
        $err_pass = "* Contraseña no introducida";
        $errores = 1;
    } elseif (strlen($contrasena_nueva) > 255) {
        $err_pass3 = "* Contraseña demasiado larga (máx. 255 caracteres)";
        $errores = 1;
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $contrasena_nueva2)) {
        $err_pass4 = "* La contraseña debe tener al menos 6 caracteres y contener al menos un número";
        $errores = 1;
    }

    if ($contrasena_nueva != $contrasena_nueva2) {
        $err_pass5 = "* Las contraseñas no coinciden.";
        $errores = 1;
    }


    if (empty($nombre)) {
        $err_nom = "* Nombre no introducido";
        $errores = 1;
    } elseif (strlen($nombre) > 255) {
        $err_nom2 = "* Nombre demasiado largo (máx. 255 caracteres)";
        $errores = 1;
    }


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


    foreach ($datos as $res) {
        if ($email == $res->email) {
            $err_email4 = "* El e-mail ya se encuentra en uso.";
            $errores = 1;
        }
    }

    if (isset($_POST["rol"])) {
        
        switch ($rol) {
            case '1':
                $rol = 1;
                break;
            case '2':
                $rol = 2;
                break;
        }
    }


    $passHash = password_hash($contrasena_nueva, PASSWORD_DEFAULT);


    if ($errores != 1) {
        
        if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2) {
            $sql = $conexion->prepare("INSERT INTO usuarios(email, nombre, clave, id_rol)  VALUES(?,?,?)");
            $res = $sql->execute([$email, $nombre, $passHash, $rol]);
        } else {
            $sql = $conexion->prepare("INSERT INTO usuarios(email, nombre, clave)  VALUES(?,?,?)");
            $res = $sql->execute([$email, $nombre, $passHash]);
        }

        
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