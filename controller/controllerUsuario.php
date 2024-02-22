<?php
require_once 'conexion.php';
require_once '../model/Usuario.php';

class controllerUsuario{
    public static function encontrar($user){
        $con = new conexion();
        
        $result = $con->query("Select * from usuario where user = '$user';");
        
        //si es emnor de 1 no ha encontrado ningun usuario
        if($con->affected_rows<1){
            return false;
        }
        else{
            $usuario = $result->fetch_object();
        
            $con->close();
            return $usuario;
        }
        
        
    }
    
}

