<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="sass/main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-xFjL7q46UDkY68eF6X4oVDwguOJ35VCrBIbPHfpb05sddq5qrruc5FyX3qMwxmX3ajg9dEViJIyTgId+6OypRQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="theme-stylesheet" rel="stylesheet" href="main.css">
    <title><?php echo $titulo; ?></title>
</head>
<?php
include("./Controller/seguridad.php");
include("./Controller/getUsuario.php");
include("./Controller/conectar_db.php");

$bodyClass = 'theme';

if(isset($_SESSION['id_usuario'])){

    $usuarioId = $_SESSION['id_usuario'];
    $usuario = getUsuario($conexion, $usuarioId);
    
    if (!empty($usuario)) {
        $tema = $usuario[0]->tema_activo_id;
        $bodyClass = "theme";
    
        if ($tema === 2) {
            $bodyClass = "theme--dark";
        } elseif ($tema === 3) {
            $bodyClass = "theme--lemon";
        }
    } else {
        $bodyClass = "theme"; // Valor por defecto si no se encuentra un usuario o tema específico
    }

}

?>

<body class="<?php echo $bodyClass; ?>">
    <!-- NAV -->
    <nav class="nav">
        <div class="nav__container container">
            <a class="nav__link-logo" href="./index.php"><span class="nav__logo" />KEEPZEN</span></a>
            <ul class="nav__list">
                <li class="nav__list-item"><a href="./index.php#funciona">Cómo funciona</a></li>
                <li class="nav__list-item"><a href="./diario.php">Diario</a></li>
                <li class="nav__list-item"><a href="relajate.php">Relájate</a></li>
                <li class="nav__list-item">
                    <?php if(!isset($_SESSION['autentificado'])){
                        ?>
                    <a href="registro.php">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <?php
                    }else{
                        ?>
                    <a href="perfil.php">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>