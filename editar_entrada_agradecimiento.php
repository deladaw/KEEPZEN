<?php
//Página para editar la entrada (una) de agradecimiento del usuario.
$titulo = "KeepZen - Editar agradecimiento";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("./Controller/conectar_db.php");
include("./Controller/editar_entrada.php");
include("nav.php");

verificar_permisos();
?>

<?php

$id = $_GET['id'];
$id_usuario = $_SESSION['id_usuario']; 

$query = "SELECT * FROM agradecimientos WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->execute([$id, $id_usuario]);

$entrada = $stmt->fetch(PDO::FETCH_ASSOC);


if ($entrada) {
    
    ?>
<div class="editar-agradecimiento container">
    <h2 class="heading-secondary">Editar agradecimiento</h2>
    <div>
        <p class="error-msg"><?php if(isset($err_vacio)){echo $err_vacio; }?></p>
        <p class="error-msg"><?php if(isset($err_textLG)){echo $err_textLG; }?></p>
    </div>
    <div class="card-greet">
        <div class="card-greet__title">
            <h5 class="heading-quinary">Fecha:</h5>
            <a class="card-greet__delete" href="confirmarEliminarEntrada.php?id=<?= $entrada['id'] ?>.php">&times;</a>
            <div class="edit-container">
                <p><b><?= (new DateTime($entrada['fecha_creacion']))->format('d-m-Y') ?></b></p>
            </div>
        </div>
        <form action="" method="POST">
            <input type="hidden" name="id_entrada" value="<?= $entrada['id'] ?>">
            <textarea id="textBox1" name="content" TextMode="MultiLine" onkeyup="setHeight('textBox1');"
                onkeydown="setHeight('textBox1');" class="card-greet__text"
                id="agradecimiento"><?= $entrada['agradecimiento'] ?></textarea>
            <div class="submit-container">
                <button name="editar" type="submit" class="btn">EDITAR</button>
            </div>
        </form>
    </div>

</div>
<?php
} else {
    ?>
<div class="editar-agradecimiento container" <h4 class="heading-secondary">La entrada de agradecimiento no existe.</h4>
</div>

<?php
}
?>
<!--JAVASCRIPT-->
<script type="text/javascript">
//He agregado este script en el HTML porque es poquito.
//Este script hace que el textbox se expanda conforme escribe el usuario.
function setHeight(fieldId) {
    document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight + 'px';
}
setHeight('textBox1');
</script>
<?php
include("footer.php");
?>