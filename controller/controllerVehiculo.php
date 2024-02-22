<?php
require_once 'conexion.php';
require_once '../model/Vehiculo.php';

class controllerVehiculo{
    public static function encontrar($matri){
        $con = new conexion();
        
        $result = $con->query("Select * from vehiculo where matricula = '$matri';");
        
        if($con->affected_rows > 0){
            //se ha encontrado un vehiculo que corresponde a la matricula
            return true;
        }
        else{
            //No se ha encontrado ningun vehiculo
            return false;
            
        }

        
    }
    
    public static function encontrarDatos($matri) {
        $con = new conexion();
        
        $result = $con->query("Select * from vehiculo where matricula = '$matri';");
        
        $vehi = $result->fetch_object();
        
        $con->close();
        return $vehi;
    }
    
    
    
    public static function actualizarFecha($matri,$fecha) {
        $con = new conexion();
        
        $con->query("Update vehiculo set fecha_ultima_revision='$fecha' where matricula='$matri'");
       
        
        $filasAfectadas = $con->affected_rows;

        $con->close();
        return $filasAfectadas;
    }
    
}