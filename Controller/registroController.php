<?php
//Con este código validamos el formulario e insertamos el nuevo usuario en la base de datos.
include("./Model/conectar_db.php");


if (isset($_REQUEST['crear'])) {
    
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $contrasena_nueva = $_POST["password"];
    $contrasena_nueva2 = $_POST["password2"];

    $errores = 0;

        if(isset($_POST["rol"])){
            $rol = $_POST["rol"];
    
        }
    
        $resultado= $conexion->prepare("SELECT * FROM usuarios");
        $resultado->execute();
        $datos = $resultado->fetchAll(PDO::FETCH_OBJ);
    
    
        //Validación de la política de privacidad
        if(!isset($_POST['policy']) || $_POST['policy'] == ""){  
            $err_pol = "* Debes aceptar la política de privacidad";
            $errores = 1;
        }
        
    
        //Validación de la contraseña, no puede estar vacía ni ser mayor de 255 caracteres
        if (empty($contrasena_nueva)) {
            $err_pass = "* Contraseña no introducida";
            $errores = 1;
        }elseif(strlen($contrasena_nueva) > 255){
            $err_pass2 = "* Contraseña demasiado larga (máx. 255 caracteres)";
            $errores = 1;
        }
    
        //Validación de la contraseña introducida nuevamente, no puede estar vacía ni ser mayor de 255 caracteres
        if (empty($contrasena_nueva2)) {
            $err_pass = "* Contraseña no introducida";
            $errores = 1;
        }elseif(strlen($contrasena_nueva) > 255){
            $err_pass3 = "* Contraseña demasiado larga (máx. 255 caracteres)";
            $errores = 1;
        }
    
        if( $contrasena_nueva != $contrasena_nueva2){
            $err_pass4 = "* Las contraseñas no coindicen.";
            $errores = 1;
        }
    
    
        // Validación del nombre, no puede estar vacío ni ser mayor de 255 caracteres.
        if (empty($nombre)) {
            $err_nom = "* Nombre no introducido";
            $errores = 1;
        }elseif(strlen($nombre) > 255){
            $err_nom2 = "* Nombre demasiado largo (máx 255 caracteres).";
            $errores = 1;
        }
    
        //Validación del email, no puede estar vacío y tiene que tener un @ y un punto, tampoco ser mayor de 250 caracteres.
        if (empty($email)) {
            $err_email = "* Email no introducido";
            $errores = 1;
        }elseif(!preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $email)){
            $errores = 1;
            $err_email2 = '* Por favor, introduce un email válido.';
        }elseif(strlen($email) > 250){
            $err_email3 = "* Por favor, introduce un email menor a 250 caracteres.";
            $errores = 1;
        }
        //Se busca si el nombre de usuario está en la base de datos, restringiendo que esté duplicado.
        foreach($datos as $res){
            if($email == $res->email){
                $err_email4 = "* El e-mail ya se encuentra en uso.";
                $errores = 1;
            }
            
        }
     
        if(isset($_POST["rol"])){
            
            //Selección del ROL
            switch ($rol) {
               case '1':
                   $rol = 1;
                   break;
               case '2':
                   $rol = 2;
                   break;
               }
    
        }
    
        //Cifrado de contraseña con método HASH:
        $passHash = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
        //Si no hay ningún error se insertan los datos y se redirige al login.
        if($errores != 1){

            //Si el usuario es admin (rol = 2), tendrá una variable más que será la de añadir y seleccionar el rol de el cliente.
            if(isset($_SESSION['rol']) && $_SESSION['rol']=2){
                
                $sql = $conexion->prepare("INSERT INTO usuarios(email, nombre, clave, id_rol)  VALUES(?,?,?)");
                $res = $sql->execute([$email,$nombre, $passHash, $rol]);
    
            }else{
               
                $sql = $conexion->prepare("INSERT INTO usuarios(email, nombre, clave)  VALUES(?,?,?)");
                $res = $sql->execute([$email,$nombre, $passHash]);
               
            }
            //No me funcionaba el header para redirigir, por problemas con los echos en el NAV, así que he usado JavaScript.
                if ($res) {

                    $resultado= $conexion->prepare("SELECT * FROM usuarios WHERE email = ? ");
                    $resultado->execute([$email]);
                    $datos = $resultado->fetch(PDO::FETCH_OBJ);

                    session_status() === PHP_SESSION_ACTIVE ?: session_start();
                    $_SESSION['email'] = $datos->email;
                    $_SESSION['nombre_usuario'] = $datos->nombre;
                    $_SESSION['id_usuario'] = $datos->id;
                    $_SESSION['autentificado'] = true;
                    $_SESSION['rol'] = $datos->id_rol;

                    if($datos){
                        ?><script>
location.replace("cuenta_creada.php");
</script> <?php
                    }

                }
    }


    }


?>