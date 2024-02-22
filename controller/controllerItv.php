<?php
require_once 'conexion.php';
require_once '../model/Itv.php';

class controllerItv{
    public static function encontrar($provincia){
        $con = new conexion();
        
        $result = $con->query("Select * from itvs where provincia = '$provincia';");
        
        if($con->affected_rows <1){
            return false;
        }
        
        return $result;
         
    }
    
}

