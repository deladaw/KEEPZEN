<?php
$titulo = "KeepZen - Diario agradecimiento";
include("./Controller/seguridad.php");
include("./Controller/conectar_db.php");
include("nav.php");
?>
<?php
$id_usuario = $_SESSION['id_usuario'];

// Obtener el número total de agradecimientos del usuario
$sql = "SELECT COUNT(*) AS total FROM agradecimientos WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$totalAgradecimientos = $resultado['total'];

// Calcular el número de páginas necesarias
$entradasPorPagina = 5;
$totalPaginas = ceil($totalAgradecimientos / $entradasPorPagina);

// Obtener el número de página actual
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$paginaActual = max(1, min($paginaActual, $totalPaginas));

// Calcular el índice de inicio y fin para la consulta SQL
$indiceInicio = ($paginaActual - 1) * $entradasPorPagina;
$indiceFin = $indiceInicio + $entradasPorPagina;

// Obtener las entradas de agradecimiento para la página actual
$sql = "SELECT * FROM agradecimientos WHERE id_usuario = ? ORDER BY fecha_creacion DESC LIMIT ?, ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $id_usuario, PDO::PARAM_INT);
$stmt->bindParam(2, $indiceInicio, PDO::PARAM_INT);
$stmt->bindParam(3, $entradasPorPagina, PDO::PARAM_INT);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<section class="diario-agradecimiento container">
    <h2 class="heading-secondary">Tus agradecimientos</h2>
    <div class="diario-agradecimiento__cards">
        <?php if (count($res) > 0): ?>
        <?php foreach($res as $dato): ?>
        <div class="card-greet">
            <div class="card-greet__title">
                <h5 class="heading-quinary">Fecha:</h5>
                <a class="card-greet__delete" href="confirmarEliminarEntrada.php?id=<?=$dato->id ?>" .php">&times;</a>
                <!-- <a class="card-greet__delete" href="./Controller/eliminarEntrada.php?id=?=$dato->id?>">&times;</a> -->
                <p><b><?= (new DateTime($dato->fecha_creacion))->format('d-m-Y') ?></b></p>
            </div>
            <p class="card-greet__text"><?= $dato->agradecimiento ?></p>
            <?php if (strlen($dato->agradecimiento) > 250): ?>
            <span class="card-greet__text-expand">Ver más</span>
            <?php endif; ?>
            <!-- Agrega el botón de eliminar con un data-atributo que contenga el id de la entrada -->
        </div>
        <?php endforeach; ?>


        <div id="demo-modal" class="modal">
            <div class="modal__content">
                <p class="sub-headline">
                    ¿Quieres eliminar esta entrada?
                </p>

                <div class="modal__btns">
                    <a href="#" class="btn eliminar-entrada" data-id="<?=$dato->id?>">Eliminar</a>
                    <a href="#" class="btn--secondary">Cancelar</a>
                </div>

                <a href="#" class="modal__close">&times;</a>
            </div>
        </div>

        <!-- Mostrar la paginación -->
        <div class="pagination">
            <?php if ($totalPaginas > 1): ?>
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i == $paginaActual): ?>
            <span class="current-page"><?= $i ?></span>
            <?php else: ?>
            <a href="?pagina=<?= $i ?>" class="page-link"><?= $i ?></a>
            <?php endif; ?>
            <?php endfor; ?>
            <?php endif; ?>
        </div>

        <?php else: ?>
        <p class="sub-heading">No tienes ninguna entrada en el diario de agradecimiento <i
                class="fas fa-feather-alt"></i></p>
        <?php endif; ?>
    </div>
</section>




<!-- FOOTER -->
<?php
include("footer.php");
?>