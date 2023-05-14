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
                <li>
                    <a href="diario_ayer.php"><i class="fas fa-caret-left"></i></a>
                </li>
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
$formato_fecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$fecha_formateada = $formato_fecha->format($fecha_actual);

?>
    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas para hoy</h2>
        <h5 class="heading-quinary"><?php echo ucfirst($fecha_formateada); ?></h5>
    </div>
    <div class="to-do-list" id="task-list">
        <img src="img/generales/tape_diary_green.svg" alt="" class="tape-diary">
        <!-- TASK ITEM -->

        <?php
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM tareas WHERE id_usuario = ? AND (DATE(fecha_creacion) = CURDATE() OR favorita = 1)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
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
            <input type="checkbox" class="task-checkbox" data-id="<?= $dato->id ?>"
                <?php if ($completada) { echo "checked"; } ?>>
            <p class="task-text"><?= $dato->tarea ?></p>
            <a href="./Controller/eliminar_tarea.php?id=<?= $dato->id ?>" class="delete-task">X</a>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- AÑADIR REGISTROS LIST -->
    <form action="" method="POST" id="add-task-form">
        <textarea placeholder="Escribe una tarea..." class="diary__entry" name="tarea" id="tarea" cols="70"
            rows="3"></textarea>
        <input type="submit" value="AÑADIR TAREA" name="enviartarea" class="btn add-entry" id="add-task-button">
    </form>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>