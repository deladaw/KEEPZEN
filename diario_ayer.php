<?php
//Página que te muestra en tu agenda el día de ayer con las tareas que has completado o no.
//Puedes mover las tareas que no has completado al día siguiente (día actual).
$titulo = "KeepZen - Agenda - Ayer";
include("./Controller/seguridad.php");
include("./Controller/guardar_tarea.php");
include("./Controller/conectar_db.php");
include("nav.php");
?>

<!-- DIARIO -->
<section class="diary container" id="diario_ayer">
    <!-- DIARIO NAV -->
    <nav class="diary__nav">
        <ul class="diary__nav-list">
            <div class="diary__icon">
                <li><a href="#">Ayer</a></li>
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
    //Obtengo la fecha de ayer local y la formateo
    setlocale(LC_ALL, 'es_ES.UTF-8');
    $fecha_actual = new DateTime();
    $fecha_ayer = $fecha_actual->sub(new DateInterval('P1D')); 
    $formato_fecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $fecha_formateada = $formato_fecha->format($fecha_ayer);

    ?>

    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas de ayer</h2>
        <h5 class="heading-quinary"><?php echo ucfirst($fecha_formateada); ?></h5>
    </div>

    <div class="to-do-list" id="task-list">
        <img src="img/generales/<?php
  if ($bodyClass === 'theme--dark') {
    echo 'tape_diary_flowers.svg';
  } elseif ($bodyClass === 'theme--lemon') {
    echo 'tape_diary_lemon.svg';
  } elseif ($bodyClass === 'theme--dracula') {
    echo 'tape_diary_dracula.svg';
  } else {
    echo 'tape_diary.svg';
  }
?>" alt="washitape decorativa" class="tape-diary">

        <?php
$id_usuario = $_SESSION['id_usuario'];
//Esta consulta selecciona solamente las tareas del día anterior que han sido o no completadas
//Si la tarea no ha sido completada, se puede mover al día siguiente (día actual).
$sql = "SELECT * FROM tareas WHERE id_usuario = ? AND (fecha_completada IS NULL OR fecha_completada >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)) AND fecha_creacion >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND fecha_creacion < CURDATE()";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$res = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

        <?php
        if(empty($res)){
            echo '<p class="no-tasks">No tienes ninguna tarea.</p>';
        }else{

        foreach($res as $dato): ?>
        <div class="task-item">
            <?php if ($dato->fecha_completada != NULL): ?>
            <p class="task-text completed ayer-completed"><?= $dato->tarea ?></p>
            <?php else: ?>
            <p class="task-text ayer-no-completed"><?= $dato->tarea ?></p>
            <a href="./Controller/mover_tarea_a_hoy.php?id=<?= $dato->id ?>" class="move-to-today"
                data-task-id="<?= $dato->id ?>"><i class="fas fa-arrow-alt-circle-right"></i></a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <?php
        }
        ?>
</section>

<?php
include("footer.php");
?>