<?

if(isset($_POST["enviar"])){
    // Incluimos el modelo
    require_once('models/UsuarioModel.php');
    $usuarioModel = new UsuarioModel();
    
    $usu = $_POST["email"];
    $pwd = $_POST["clave"];

    // Comprobamos si el usuario y la contraseña son válidos
    if($usuarioModel->comprobarCredenciales($usu, $pwd)){
        session_start();
        $_SESSION['usuario'] = $usu;
        $_SESSION['autentificado'] = true;
        $_SESSION['rol'] = $usuarioModel->obtenerRol($usu);
        header("Location: index.php");
        exit;
    }else{
        $error_pass = '*Usuario o contraseña incorrectos';
    }
}

// Incluimos la vista
require_once('views/login.php');

?>