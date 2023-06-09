<?php
include 'seguridad.php';
include("conectar_db.php");

$resultados = array(); // Variable para almacenar los resultados de búsqueda

if (isset($_GET['q'])) {
    $query = $_GET['q'];

    // Ejecutar la consulta SQL para obtener los resultados de búsqueda
    $sql = "SELECT * FROM agradecimientos WHERE agradecimiento LIKE :query";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>

<!-- Aquí puedes mostrar los resultados de búsqueda -->
<?php foreach ($resultados as $dato): ?>
<!-- Código para mostrar cada resultado -->
<?php endforeach; ?>