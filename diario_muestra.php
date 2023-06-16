<?php
//Página donde te enseña cómo es el uso de la Agenda.
//Abajo del todo hay una serie de instrucciones.
$titulo = "KeepZen - Agenda Ejemplo";
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
                    <a href="registro.php"><i class="fas fa-caret-left"></i></a>
                </li>
                <li><a href="registro.php">Ayer</a></li>
            </div>

            <li><a href="diario_muestra.php">Hoy</a></li>
            <div class="diary__icon">
                <li><a href="registro.php">Mañana</a></li>
                <li>
                    <a href="registro.php"><i class="fas fa-caret-right"></i></i></a>
                </li>
            </div>
        </ul>
    </nav>

    <?php
setlocale(LC_ALL, 'es_ES.UTF-8');
$fecha_actual = new DateTime();
$formato_fecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$fecha_formateada = $formato_fecha->format($fecha_actual);
?>
    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas para hoy</h2>
        <h5 class="heading-quinary"><?php echo ucfirst($fecha_formateada); ?></h5>
    </div>
    <div class="to-do-list list-muestra">
        <div class="task-muestra">
            <div class="muestra-container">
                <i class="fas fa-heart"></i>
                <input type="checkbox" class="task-checkbox" disabled>
                <p class="muestra">Pasear a pancho</p>
            </div>
            <p class="delete-muestra">X</p>
        </div>
        <div class="task-muestra">
            <div class="muestra-container">
                <i class="fas fa-heart heart-marked"></i>
                <input type="checkbox" class="task-checkbox" disabled>
                <p class="muestra">Ir al gym</p>
            </div>
            <p class="delete-muestra">X</p>
        </div>
        <div class="task-muestra">
            <div class="muestra-container">
                <i class="fas fa-heart"></i>
                <input type="checkbox" class="task-checkbox" disabled>
                <p class="muestra">Recoger el encargo de Natura</p>
            </div>
            <p class="delete-muestra">X</p>
        </div>
        <div class="task-muestra">
            <div class="muestra-container">
                <i class="fas fa-heart"></i>
                <input type="checkbox" class="task-checkbox" checked disabled>
                <p class="muestra-tachada">Felicitar a Sonia</p>
            </div>
            <p class="delete-muestra">X</p>
        </div>
    </div>

    <!-- AÑADIR REGISTROS LIST -->
    <div class="muestra-form">
        <textarea placeholder="Aquí puedes escribir las tareas pendientes y añadirlas con este botón"
            class="diary__entry" name="" id="" cols="70" rows="3"></textarea>
        <img src="img/generales/arrow_2.svg" alt="flecha que indica el botón añadir tarea" class="flecha1">
    </div>
    <a href="registro.php" class="btn add-entry">AÑADIR TAREA</a>

    <div class="instrucciones">
        <h4 class="heading-quaternary">Instrucciones</h4>
        <div class="instrucciones__fav">
            <i class="fas fa-heart heart-marked"></i>
            <p>Haciendo clic en el corazón marcas esa tarea
                como <b>favorita,</b> es decir, siempre te saldrá en el
                día
                de Hoy y de mañana</p>
        </div>
        <div class="instrucciones__check">
            <input type="checkbox" class="task-checkbox" checked disabled>
            <p>Puedes marcar las <b>tareas
                    realizadas.</b>En la vista de ayer te aparecerá como realizada (tachada).</p>
        </div>
        <div class="instrucciones__ayer">
            <i class="fas fa-arrow-alt-circle-right"></i>
            <p>Si hay alguna tarea que no has realizado
                durante el día, puedes <b>moverlas</b> del día de ayer al día de hoy.</p>
        </div>
        <div class="instrucciones__eliminar">
            <p class="equis">X</p>
            <p>Puedes <b>eliminar</b> cualquier tarea de la lista pulsando en la equis.</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>