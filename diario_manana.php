<?php
$titulo = "KeepZen - Diario - Mañana";
include("./Model/conectar_db.php");
include("./Controller/seguridad.php");
include("./Controller/enviarmanana.php");
include("nav.php");
?>


<!-- DIARIO -->
<section class="diary container">
    <!-- DIARIO NAV -->
    <nav class="diary__nav">
        <ul class="diary__nav-list">
            <div class="diary__icon">
                <li>
                    <a href="diario_ayer.php"><i class="fas fa-caret-left"></i></a>
                </li>
                <li><a href="diario_ayer.php">Ayer</a></li>
            </div>

            <li><a href="diario.php">Hoy</a></li>
            <div class="diary__icon">
                <li><a href="tareas_manana.php">Mañana</a></li>
            </div>
        </ul>
    </nav>
    <?php
setlocale(LC_ALL, 'es_ES.UTF-8');
$fecha_actual = new DateTime();
$fecha_actual->modify('+1 day'); // sumar un día a la fecha actual
$formato_fecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$fecha_formateada = $formato_fecha->format($fecha_actual);
?>

    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas para mañana</h2>
        <h5 class="heading-quinary"><?php echo ucfirst($fecha_formateada); ?></h5>
    </div>

    <div class="to-do-list" id="task-list">
        <img src="img/generales/tape_diary_green.svg" alt="" class="tape-diary">
        <!-- TASK ITEM -->

        <?php
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM tareas WHERE id_usuario = :id_usuario AND (favorita = 1 OR fecha_creacion = DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY))";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$res = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

        <?php foreach($res as $dato): ?>
        <?php
    $completada = $dato->fecha_completada != NULL;
    ?>
        <div class="task-item">
            <img src="img/generales/tape_diary_green.svg" alt="" class="tape-diary">

            <a href="./Controller/tarea_favorita.php?id=<?= $dato->id ?>" class="favorite-task">
                <i class="fas fa-heart <?= isset($dato->favorita) && $dato->favorita ? 'favorite' : '' ?>"
                    style="cursor: pointer; margin-right: 5px;"></i>
            </a>
            <p class="task-text"><?= $dato->tarea ?></p>
            <a href="./Controller/eliminar_tarea.php?id=<?= $dato->id ?>" class="delete-task">X</a>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- AÑADIR REGISTROS LIST -->
    <form action="" method="POST">
        <textarea placeholder="Escribe una tarea..." class="diary__entry" name="tarea" id="tarea" cols="70"
            rows="3"></textarea>
        <input type="submit" value="AÑADIR TAREA" name="enviarmanana" class="btn add-entry">
    </form>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>