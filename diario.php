<?php
$titulo = "KeepZen - Diario";
include("./Controller/seguridad.php");
include("nav.php");
?>


<!-- DIARIO -->
<section class="diary container">
    <!-- DIARIO NAV -->
    <nav class="diary__nav">
        <ul class="diary__nav-list">
            <div class="diary__icon">
                <li>
                    <a href=""><i class="fas fa-caret-left"></i></a>
                </li>
                <li><a href="">Ayer</a></li>
            </div>

            <li><a href="">Hoy</a></li>
            <div class="diary__icon">
                <li><a href="">Mañana</a></li>
                <li>
                    <a href=""><i class="fas fa-caret-right"></i></i></a>
                </li>
            </div>
        </ul>
    </nav>
    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas para hoy</h2>
        <h5 class="heading-quinary">Lunes, 6 de Marzo</h5>
    </div>

    <div class="to-do-list" id="task-list">

    </div>

    <div class="diary__entry-btns">
        <button class="btn">BORRAR</button>
        <button class="btn--secondary">EDITAR</button>
    </div>

    <!-- AÑADIR REGISTROS LIST -->
    <form action="">
        <textarea placeholder="Leer un capítulo a la semana" class="diary__entry" name="" id="" cols="70"
            rows="3"></textarea>
    </form>
    <button class="btn add-entry">AÑADIR TAREA</button>

    <!-- DIARIO AGRADECIMIENTO -->
    <div class="greet">
        <h2 class="heading-secondary greet__title">¿Por qué te sientes agradecido/a hoy?</h2>
        <form action="">
            <textarea
                placeholder="Por ej: Tener una mascota que te quiere, tomar un café en un día soleado, tener la oportunidad de aprender cosas nuevas cada día..."
                class="diary__entry" name="" id="" cols="70" rows="3"></textarea>
        </form>
        <button class="btn add-entry">ANOTAR</button>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>