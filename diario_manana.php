<?php
//Página que te muestra la agenda en el día de mañana.
//Las tareas que apuntes en el día de mañana, te aparecerán al día siguiente en el día actual.
$titulo = "KeepZen - Agenda - Mañana";
include("./Controller/conectar_db.php");
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("nav.php");

verificar_permisos();
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
                <li><a href="#">Mañana</a></li>
            </div>
        </ul>
    </nav>
    <?php
    //Obtengo la fecha de mañana local y la formateo
    setlocale(LC_ALL, 'es_ES.UTF-8');
    $fecha_actual = new DateTime();
    $fecha_actual->modify('+1 day'); 
    $formato_fecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $fecha_formateada = $formato_fecha->format($fecha_actual);
    ?>

    <!-- DIARIO TITLE -->
    <div class="diary__title">
        <h2 class="heading-secondary">Tareas para mañana</h2>
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
        <!-- TASK ITEM -->

        <?php
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM tareas WHERE id_usuario = :id_usuario AND (favorita = 1 OR fecha_creacion = DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY))";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$res = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

        <?php 
if(empty($res)) {
    echo '<p class="no-tasks">No tienes ninguna tarea para mañana.</p>';
} else {
    foreach($res as $dato): 
        $completada = $dato->fecha_completada != NULL;
?>
        <div class="task-item">


            <a href="./Controller/tarea_favorita.php?id=<?= $dato->id ?>" class="favorite-task">
                <i class="fas fa-heart <?= isset($dato->favorita) && $dato->favorita ? 'favorite' : '' ?>"
                    style="cursor: pointer; margin-right: 5px;"></i>
            </a>
            <p class="task-text"><?= $dato->tarea ?></p>
            <a href="./Controller/eliminar_tarea.php?id=<?= $dato->id ?>" class="delete-task">X</a>
        </div>
        <?php 
    endforeach; 
}
?>
    </div>
    <!-- AÑADIR REGISTROS LIST -->
    <form action="./Controller/enviarmanana.php" method="POST" id="add-task-form-manana">
        <textarea placeholder="Escribe una tarea..." class="diary__entry" name="tarea_manana" id="tarea_manana"
            cols="70" rows="3"></textarea>
        <input type="submit" value="AÑADIR TAREA" name="enviarmanana" class="btn add-entry">
    </form>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>