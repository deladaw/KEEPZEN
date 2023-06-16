<?php
//Página para practicar ejercicios de respiración y estiramientos.
$titulo = "KeepZen - Relájate";
include("./Controller/seguridad.php");
include("./Controller/conectar_db.php");
include("nav.php");

?>

<!-- EJERCICIO RESPIRACIÓN -->
<section class="relax container">
    <h2 class="heading-secondary">Respira.</h2>
    <p class="relax__headline">
        Tómate 5 minutos para respirar y conectar con tu cuerpo. Dale al play
        cuando estés preparado/a y sigue las indicaciones.
    </p>
    <div class="circle-container">
        <div class="sphere">
            <div class="sphere-inner" id="sphere-inner"></div>
            <p class="inspira">inspira</p>
            <p class="espira">espira</p>
        </div>
    </div>
    <div class="play-container">
        <button class="btn play" id="play">
            <i class="fas fa-play"></i>
        </button>
    </div>
</section>
<section class="stretch container">
    <h2 class="heading-secondary">Estira.</h2>
    <p class="stretch__headline">
        Ponte cómodo/a y realiza estos estiramientos para despertar tu cuerpo.
    </p>
    <div class="video-container">
        <iframe class="stretch__video" width="560" height="315" src="https://www.youtube.com/embed/X7VKWcsIPoM"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>