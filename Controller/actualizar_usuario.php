<?php
//Código para actualizar el usuario desde la tabla "gestión de usuarios" por el admin.
include("conectar_db.php");
include("seguridad.php");

if (isset($_REQUEST['id'])) {
    $idUsuario = $_REQUEST['id'];
    $email = $_REQUEST['email'];
    $nombre = $_REQUEST['nombre'];
    $activo = $_REQUEST['activo'];
    $idRol = $_REQUEST['id_rol'];
    $fechaRegistro = $_REQUEST['fecha_registro'];
    $temaComprado = $_REQUEST['tema_comprado'];

    $error = 0;

    if (empty($email)) {
        $error = 1;
        echo 'error en email';
    }
    if (empty($nombre)) {
        $error = 1;
        echo 'error en nombre';
    }

    if (empty($idRol)) {
        $error = 1;
        echo 'error en idRol';
    }
    if (empty($fechaRegistro)) {
        $error = 1;
        echo 'error en fecha_registro';
    }

    if ($activo != 0 && $activo != 1) {
        $error = 1;
        echo 'error en activo 2';
    }

    if ($temaComprado != 0 && $temaComprado != 1) {
        $error = 1;
        echo 'error en temaComprado';
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 1;
        echo 'error en email 2';
    }


    if (!empty($nombre) && preg_match('/[0-9]/', $nombre)) {
        $error = 1;
        echo 'error en nombre 2';
    }

    if ($error != 1) {
    
        if ($activo == 0) {
            $fechaBaja = date('Y-m-d');
        } else {
            $fechaBaja = !empty($_REQUEST['fecha_baja']) ? $_REQUEST['fecha_baja'] : null;
        }

        $sql_actualizacion = "UPDATE usuarios SET email = ?, nombre = ?, activo = ?, id_rol = ?, fecha_registro = ?, fecha_baja = ?, tema_comprado = ? WHERE id = ?";
        $stmt_actualizacion = $conexion->prepare($sql_actualizacion);
        $stmt_actualizacion->execute([$email, $nombre, $activo, $idRol, $fechaRegistro, $fechaBaja, $temaComprado, $idUsuario]);

        exit;
    } else {
        
        echo $error . "<br>";
    }
}
?>