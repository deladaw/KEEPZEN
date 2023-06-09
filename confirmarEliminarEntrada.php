<?php
$titulo = "KeepZen - Confirmar eliminar";
include("./Controller/conectar_db.php");
include("nav.php");
?>
<section class="confrimar-eliminar">
    <div class="eliminar container">
        <?php
        // Verificar si se ha proporcionado el parámetro "id" en la URL
        if (isset($_GET["id"])) {
            // Obtener el ID de la entrada a eliminar
            $id_entrada = $_GET["id"];

            // Obtener el ID de usuario de la sesión
            $id_usuario_sesion = $_SESSION["id_usuario"];

            // Realizar la consulta para obtener la entrada específica
            $query = "SELECT * FROM agradecimientos WHERE id = ?";
            $stmt = $conexion->prepare($query);
            $stmt->execute([$id_entrada]);
            $entrada = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró la entrada y si el ID de usuario coincide
            if ($entrada && $entrada["id_usuario"] == $id_usuario_sesion) {
                ?>
        <h3 class="heading-tertiary eliminar__title">¿Estás seguro de que quieres <span
                class="eliminar__highlight">eliminar</span> la entrada?</h3>

        <div class="eliminar__btns">
            <a class="btn--secondary" href="<?= $_SERVER["HTTP_REFERER"] ?>">Cancelar</a>
            <a class="btn" href="./Controller/eliminarEntrada.php?id=<?= $_GET["id"] ?>">Eliminar</a>
        </div>
        <?php
            } else {
                // Mostrar un mensaje de error o redirigir al usuario
                echo "No tienes permiso para eliminar esta entrada.";
                // Opcionalmente, redirigir al usuario a la página de inicio
                // header("Location: index.php");
                // exit();
            }
        } else {
            // Si no se proporcionó el parámetro "id" en la URL
            echo "No se ha especificado una entrada para eliminar.";
            // Opcionalmente, redirigir al usuario a la página de inicio
            // header("Location: index.php");
            // exit();
        }
        ?>
    </div>
</section>
<?php
include 'footer.php';
?>