<?php
//Código para canjear el cupón de compra. Si es = a DBS se confirma la "compra".
include 'seguridad.php';
include("conectar_db.php");

if (isset($_REQUEST['canjear'])) {
    $cupon = $_REQUEST['cupon'];
    $id_usuario = $_SESSION['id_usuario'];
    $email = $_SESSION['email'];

    if ($cupon === 'DBS') {
        
        $sql = "UPDATE usuarios SET tema_comprado = 1 WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_usuario]);

        
        if ($stmt->rowCount() > 0) {
           
            $fechaCompra = date('Y-m-d');
            $producto = 'Theme Pack';
            $precio = 0.00;
            
            
            $sql = "INSERT INTO factura (usuario_id, fecha_compra, producto, precio, email_compra) VALUES (:userId, :fechaCompra, :producto, :precio, :email)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':userId', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':fechaCompra', $fechaCompra, PDO::PARAM_STR);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            header('Location: temas.php');
        } else {
            $err_cupon = '* Cupón no válido.';
        }
    } else {
        $err_cupon = '* Cupón no válido.';
    }
}
?>