<?php
$titulo = "KeepZen - Diario";
include("./Controller/seguridad.php");
include("./Model/guardar_tarea.php");
include("./Model/conectar_db.php");
include("nav.php");
?>


<!-- DIARIO -->
<section class="diary container">
    <!-- DIARIO NAV -->
    <nav class="diary__nav">
        <ul class="diary__nav-list">
            <div class="diary__icon">
                <li><a href="diario_ayer.php">Ayer</a></li>
            </div>

            <li><a href="diario.php">Hoy</a></li>
            <div class="diary__icon">
                <li><a href="diario_manana.php">Mañana</a></li>
                <li>
                    <a href="diario_manana.php"><i class="fas fa-caret-right"></i></i></a>
                </li>
            </div>
        </ul>
    </nav>
    <?php
setlocale(LC_ALL, 'es_ES.UTF-8');
$fecha_actual = new DateTime();
$fecha_ayer = $fecha_actual->sub(new DateInterval('P1D')); // restar un día a la fecha actual
$formato_fecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$fecha_formateada = $formato_fecha->format($fecha_ayer);

?>

    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas completadas ayer</h2>
        <h5 class="heading-quinary"><?php echo ucfirst($fecha_formateada); ?></h5>
    </div>

    <div class="to-do-list" id="task-list">
        <img src="img/generales/tape_diary_green.svg" alt="" class="tape-diary">

        <?php
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT * FROM tareas WHERE id_usuario = ? AND (fecha_completada >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) OR fecha_completada IS NULL) AND fecha_creacion < CURDATE()";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id_usuario]);
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    ?>

        <?php foreach($res as $dato): ?>
        <?php $completada = $dato->fecha_completada != NULL; ?>
        <div class="task-item">
            <img src="img/generales/tape_diary_green.svg" alt="" class="tape-diary">
            <?php if ($completada): ?>
            <p class="task-text completed ayer-completed"><?= $dato->tarea ?></p>
            <?php else: ?>
            <p class="task-text ayer-no-completed"><?= $dato->tarea ?></p>
            <a href="./Controller/actualizar_tarea.php?id=<?= $dato->id ?>" class="move-to-today"><i
                    class="fas fa-arrow-alt-circle-right"></i></a>
            <form action="./Controller/actualizar_tarea.php" method="POST" style="display: none;">
                <input type="hidden" name="id" value="<?= $dato->id ?>">
            </form>
            <?php endif; ?>
        </div>

        <?php endforeach; ?>
    </div>

    <form action="" method="POST">
        <textarea placeholder="Escribe una tarea..." class="diary__entry" name="tarea" id="tarea" cols="70"
            rows="3"></textarea>
        <input type="submit" value="AÑADIR TAREA" name="enviartarea" class="btn add-entry">
    </form>



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