<?php
require_once 'conexion.php';
require_once '../model/Cita.php';

class controllerCita{
    public static function encontrar($matri){
        $con = new conexion();
        
        $result = $con->query("Select * from citas where matricula = '$matri';");
        
        
        if($con->affected_rows > 0){
            //existe citas de ese coche
            return false;
        }
        else{
            //no existe citas de ese coche
            return true;
        }
        
        
        
    }
    
    public static function insertar($cita){
        try {
            $con = new conexion();        
            
            $con->query("Insert into citas values('$cita->matricula','$cita->id_itv','$cita->fecha','$cita->hora','$cita->ficha')");
            
            $filasAfectadas = $con->affected_rows;
            
            $con->close();
            
            
        } catch (Exception $ex) {
            echo($ex->getCode()."-".$ex->getMessage());
            $filasAfectadas = false;
        }
        
        return $filasAfectadas;

    }
    
    
    public static function borrarCita($matri) {
        $con = new conexion();
        
        $con->execute_query("delete from citas where matricula='$matri'");
        
       if($con->affected_rows){
           return true;
       }
       else{
           return false;
       }
    }
    
    
        public static function encontrarTodas($id_itv){
        $con = new conexion();
        
        $result = $con->query("Select * from citas where id_itv = '$id_itv';");
        
        if($con->affected_rows <1){
            return false;
        }
        
        return $result;
         
    }
    
    
    
    
}
