<?php
include("./Controller/seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sass/main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <!-- NAV -->
    <nav class="nav">
        <div class="nav__container container">
            <a class="nav__link-logo" href="./index.php"><img src="./img/generales/Logotipo_keepzen.svg" alt=""
                    class="nav__logo" /></a>
            <ul class="nav__list">
                <li class="nav__list-item"><a href="#funciona">Cómo funciona</a></li>
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