<?php
require_once('conectar_db.php');

class UsuarioModel {
    
    public function comprobarCredenciales($email, $contrasena){

        
        global $conexion;
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? ");
        $stmt->execute([$email]);
        $datos = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(isset($datos->activo) && $datos->activo == 0){
            return false;
        }
        
        if ($datos == true && password_verify($contrasena,$datos->clave)){
            return true;
        }
        
        return false;
    }
    
    public function obtenerRol($email){
        global $conexion;
        $stmt = $conexion->prepare("SELECT id_rol FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $datos = $stmt->fetch(PDO::FETCH_OBJ);
        
        return $datos->id_rol;
    }
}


?>