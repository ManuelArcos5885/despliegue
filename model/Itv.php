<?php
class Itv{
    protected $id;
    protected $provincia;
    protected $localidad;
    protected $direccion;
    protected $telefono;
    
    
    public function __construct($id, $provincia, $localidad, $direccion, $telefono) {
        $this->id = $id;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name,$value) {
        $this->$name = $value;
    }
    public function __toString() {
        return "Id: ".$this->id.", Provincia: ".$this->provincia.", Localidad: ".$this->localidad.", Direccion: ".$this->direccion."Telefono: ".$this->telefono;
    }



}
?>