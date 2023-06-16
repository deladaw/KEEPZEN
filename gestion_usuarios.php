<?php
//Página de gestión de usuarios visible solo para el administrador.
$titulo = "KeepZen - Gestión de usuarios";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("nav.php");

verificar_permisos_admin();

$term = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM usuarios WHERE email LIKE :term OR nombre LIKE :term";

$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : '';
$allowedFields = ['id', 'email', 'nombre', 'activo', 'id_rol', 'fecha_registro', 'fecha_baja', 'tema_comprado'];
if (in_array($orderBy, $allowedFields)) {
    $sql .= " ORDER BY $orderBy";
}

$stmt = $conexion->prepare($sql);
$stmt->bindValue(':term', '%' . $term . '%');
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="gestion-usuarios container">
    <a href="gestion_usuarios.php">
        <h2 class="heading-secondary">Gestión de usuarios</h2>
    </a>
    <div class="form-container">
        <form class="search-form" method="GET" action="">
            <input type="text" name="search" placeholder="Buscar por email o nombre">
            <button type="submit">Buscar</button>
        </form>
    </div>


    <div class="success-icon" id="success-icon"></div>
    <table class="usuarios-table">
        <thead>
            <tr>
                <th><a href="?orderBy=id">ID</a></th>
                <th><a href="?orderBy=email">Email</a></th>
                <th><a href="?orderBy=nombre">Nombre</a></th>
                <th><a href="?orderBy=activo">Activo</a></th>
                <th><a href="?orderBy=id_rol">ID Rol</a></th>
                <th><a href="?orderBy=fecha_registro">Fecha de Registro</a></th>
                <th><a href="?orderBy=fecha_baja">Fecha de Baja</a></th>
                <th><a href="?orderBy=tema_comprado">Tema Comprado</a></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td class="editable" contenteditable="true"><?php echo $usuario['email']; ?></td>
                <td class="editable" contenteditable="true"><?php echo $usuario['nombre']; ?></td>
                <?php if ($_SESSION['id_usuario'] != $usuario['id']) : ?>
                <td class="editable">
                    <select>
                        <option value="0" <?php echo ($usuario['activo'] == 0) ? 'selected' : ''; ?>>0</option>
                        <option value="1" <?php echo ($usuario['activo'] == 1) ? 'selected' : ''; ?>>1</option>
                    </select>
                </td>
                <?php else : ?>
                <td></td>
                <?php endif; ?>
                <?php if ($_SESSION['id_usuario'] != $usuario['id']) : ?>
                <td class="editable">
                    <select>
                        <option value="1" <?php echo ($usuario['id_rol'] == 1) ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo ($usuario['id_rol'] == 2) ? 'selected' : ''; ?>>2</option>
                    </select>
                </td>
                <?php else : ?>
                <td></td>
                <?php endif; ?>
                <td class="editable" contenteditable="true"><?php echo $usuario['fecha_registro']; ?></td>
                <td class="editable" contenteditable="true"><?php echo $usuario['fecha_baja']; ?></td>
                <td class="editable">
                    <select>
                        <option value="0" <?php echo ($usuario['tema_comprado'] == 0) ? 'selected' : ''; ?>>0</option>
                        <option value="1" <?php echo ($usuario['tema_comprado'] == 1) ? 'selected' : ''; ?>>1</option>
                    </select>
                </td>
                <td>
                    <button class="btn-guardar" data-id="<?php echo $usuario['id']; ?>">Guardar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<script>
$(document).ready(function() {
    $('.btn-guardar').click(function() {
        var btnGuardar = $(this);

        var idUsuario = btnGuardar.data('id');
        var email = btnGuardar.closest('tr').find('.editable:nth-child(2)').text();
        var nombre = btnGuardar.closest('tr').find('.editable:nth-child(3)').text();
        var activo = btnGuardar.closest('tr').find('.editable:nth-child(4)').find('select').val();
        var idRol = btnGuardar.closest('tr').find('.editable:nth-child(5)').find('select').val();
        var fechaRegistro = btnGuardar.closest('tr').find('.editable:nth-child(6)').text();
        var fechaBaja = btnGuardar.closest('tr').find('.editable:nth-child(7)').text();
        var temaComprado = btnGuardar.closest('tr').find('.editable:nth-child(8)').find('select').val();

        $.ajax({
            url: './Controller/actualizar_usuario.php',
            method: 'POST',
            data: {
                id: idUsuario,
                email: email,
                nombre: nombre,
                activo: activo,
                id_rol: idRol,
                fecha_registro: fechaRegistro,
                fecha_baja: fechaBaja,
                tema_comprado: temaComprado
            },
            success: function(response) {
                //Si ha funcionado, muestra el icono de un "check".
                console.log('Se ha enviado todo correctamente.');
                $('#success-icon').addClass('animate-success');
                $('#success-icon').show();

                setTimeout(function() {
                    $('#success-icon').fadeOut(500, function() {
                        $(this).removeClass('animate-success').css(
                            'display', 'none');
                    });
                }, 600);
            },
            error: function(xhr, status, error) {
                console.log('Ha ocurrido un error')
            }
        });
    });
});
</script>

<!-- FOOTER -->
<?php
include("footer.php");
?>