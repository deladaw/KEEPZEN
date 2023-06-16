<?php
$titulo = "KeepZen - Diario agradecimiento";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("./Controller/conectar_db.php");
include("nav.php");

verificar_permisos();
?>


<?php
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT COUNT(*) AS total FROM agradecimientos WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$totalAgradecimientos = $resultado['total'];

//Paginación
$entradasPorPagina = 5;
$totalPaginas = ceil($totalAgradecimientos / $entradasPorPagina);


$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$paginaActual = max(1, min($paginaActual, $totalPaginas));

$indiceInicio = ($paginaActual - 1) * $entradasPorPagina;
$indiceFin = $indiceInicio + $entradasPorPagina;

$ordenamiento = isset($_GET['orden']) && $_GET['orden'] == 'asc' ? 'ASC' : 'DESC';

//Consulta de agradecimientos del usuario
$sql = "SELECT * FROM agradecimientos WHERE id_usuario = ? ORDER BY fecha_creacion $ordenamiento LIMIT ?, ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $id_usuario, PDO::PARAM_INT);
$stmt->bindParam(2, $indiceInicio, PDO::PARAM_INT);
$stmt->bindParam(3, $entradasPorPagina, PDO::PARAM_INT);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<section class="diario-agradecimiento container">
    <a href="entradas_diario_agradecimiento.php">
        <h2 class="heading-secondary">Tus agradecimientos</h2>
    </a>
    <div class="search">
        <div class="order">
            <a class="order__link"
                href="?orden=asc<?= isset($_GET['buscar']) ? '&buscar=true&q=' . $_GET['q'] : '' ?>"><i
                    class="fas fa-arrow-up"></i></a>
            <a class="order__link"
                href="?orden=desc<?= isset($_GET['buscar']) ? '&buscar=true&q=' . $_GET['q'] : '' ?>"><i
                    class="fas fa-arrow-down"></i></a>
        </div>
        <form action="" method="GET" class="search-form">
            <input class="search-form__input" type="text" name="q" placeholder="Buscar agradecimiento...">
            <button name="buscar" type="submit" class="search-form__btn"><i class="fas fa-search"></i></button>
            <input type="hidden" name="orden" value="<?php echo $_GET['orden'] ?? 'desc'; ?>">
        </form>
    </div>
    <div class="diario-agradecimiento__cards">
        <?php if (count($res) > 0 && !isset($_GET['buscar'])): ?>
        <?php foreach($res as $dato): ?>
        <!-- ENTRADAS -->
        <div class="card-greet">
            <div class="card-greet__title">
                <h5 class="heading-quinary">Fecha:</h5>
                <a class="card-greet__delete" href="confirmarEliminarEntrada.php?id=<?=$dato->id ?>.php">&times;</a>
                <div class="edit-container">
                    <p><b><?= (new DateTime($dato->fecha_creacion))->format('d-m-Y') ?></b></p>
                    <a class="card-greet__edit" href="editar_entrada_agradecimiento.php?id=<?=$dato->id ?>.php"><i
                            class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
            <p class="card-greet__text"><?= $dato->agradecimiento ?></p>
            <?php if (strlen($dato->agradecimiento) > 250): ?>
            <span class="card-greet__text-expand">Ver más</span>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <!-- Paginación de las ENTRADAS -->
        <div class="pagination">
            <?php if ($totalPaginas > 1): ?>
            <?php if ($paginaActual > 1): ?>
            <a class="pagination__link"
                href="?pagina=<?= $paginaActual - 1 ?>&orden=<?= $_GET['orden'] ?? 'desc' ?><?php if (isset($_GET['buscar'])) echo '&buscar=true&q=' . $_GET['q'] ?>"><i
                    class="fas fa-angle-double-left"></i></a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i == $paginaActual): ?>
            <a class="pagination__link current-page"
                href="?pagina=<?= $i ?>&orden=<?= $_GET['orden'] ?? 'desc' ?><?php if (isset($_GET['buscar'])) echo '&buscar=true&q=' . $_GET['q'] ?>"><?= $i ?></a>
            <?php else: ?>
            <a class="pagination__link"
                href="?pagina=<?= $i ?>&orden=<?= $_GET['orden'] ?? 'desc' ?><?php if (isset($_GET['buscar'])) echo '&buscar=true&q=' . $_GET['q'] ?>"><?= $i ?></a>
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
            <a class="pagination__link"
                href="?pagina=<?= $paginaActual + 1 ?>&orden=<?= $_GET['orden'] ?? 'desc' ?><?php if (isset($_GET['buscar'])) echo '&buscar=true&q=' . $_GET['q'] ?>">
                <i class="fas fa-angle-double-right"></i></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php elseif (count($res) < 1): ?>
        <p class="sub-heading">No tienes ninguna entrada en el diario de agradecimiento <i
                class="fas fa-feather-alt"></i></p>
        <?php elseif (isset($_GET['buscar'])): ?>
        <?php
            $query = $_GET['q'];

            $sql = "SELECT COUNT(*) AS total FROM agradecimientos WHERE id_usuario = :id_usuario AND agradecimiento LIKE :query";
            $stmt = $conexion->prepare($sql);
            $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalResultados = $resultado['total'];

            $totalPaginasBusqueda = ceil($totalResultados / $entradasPorPagina);
            
            $paginaActualBusqueda = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $paginaActualBusqueda = max(1, min($paginaActualBusqueda, $totalPaginasBusqueda));
            
            $indiceInicioBusqueda = ($paginaActualBusqueda - 1) * $entradasPorPagina;
            $indiceFinBusqueda = $indiceInicioBusqueda + $entradasPorPagina;
            
            $sql = "SELECT * FROM agradecimientos WHERE id_usuario = :id_usuario AND agradecimiento LIKE :query ORDER BY fecha_creacion $ordenamiento LIMIT :inicio, :fin";
            $stmt = $conexion->prepare($sql);
            $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
            $stmt->bindValue(':inicio', $indiceInicioBusqueda, PDO::PARAM_INT);
            $stmt->bindValue(':fin', $indiceFinBusqueda, PDO::PARAM_INT);
            $stmt->execute();
            $resultadosBusqueda = $stmt->fetchAll(PDO::FETCH_OBJ);
            ?>

        <?php if (count($resultadosBusqueda) > 0): ?>
        <?php foreach ($resultadosBusqueda as $dato): ?>

        <div class="card-greet">
            <div class="card-greet__title">
                <h5 class="heading-quinary">Fecha:</h5>
                <a class="card-greet__delete" href="confirmarEliminarEntrada.php?id=<?=$dato->id ?>.php">&times;</a>
                <div class="edit-container">
                    <p><b><?= (new DateTime($dato->fecha_creacion))->format('d-m-Y') ?></b></p>
                    <a class="card-greet__edit" href="editar_entrada_agradecimiento.php?id=<?=$dato->id ?>.php"><i
                            class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
            <p class="card-greet__text"><?= $dato->agradecimiento ?></p>
            <?php if (strlen($dato->agradecimiento) > 250): ?>
            <span class="card-greet__text-expand">Ver más</span>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <!-- Paginación de los resultados de búsqueda -->
        <div class="pagination">
            <?php if ($totalPaginasBusqueda > 1): ?>
            <?php if ($paginaActualBusqueda > 1): ?>
            <a class="pagination__link"
                href="?pagina=<?= $paginaActualBusqueda - 1 ?>&orden=<?= $_GET['orden'] ?? 'desc' ?>&buscar=true&q=<?= $_GET['q'] ?>"><i
                    class="fas fa-angle-double-left"></i></a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginasBusqueda; $i++): ?>
            <?php if ($i == $paginaActualBusqueda): ?>
            <a class="pagination__link current-page"
                href="?pagina=<?= $i ?>&orden=<?= $_GET['orden'] ?? 'desc' ?>&buscar=true&q=<?= $_GET['q'] ?>"><?= $i ?></a>
            <?php else: ?>
            <a class="pagination__link"
                href="?pagina=<?= $i ?>&orden=<?= $_GET['orden'] ?? 'desc' ?>&buscar=true&q=<?= $_GET['q'] ?>"><?= $i ?></a>
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($paginaActualBusqueda < $totalPaginasBusqueda): ?>
            <a class="pagination__link"
                href="?pagina=<?= $paginaActualBusqueda + 1 ?>&orden=<?= $_GET['orden'] ?? 'desc' ?>&buscar=true&q=<?= $_GET['q'] ?>">
                <i class="fas fa-angle-double-right"></i></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p class="sub-heading">No se encontraron resultados para la búsqueda <b>"<?= $_GET['q'] ?>"</b></p>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>