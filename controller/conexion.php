<?php

class conexion extends mysqli{
    protected $host="localhost";
    protected $nombreUsuario="dwes";
    protected $passUsuario="abc123.";
    protected $nombreBd="itv";
    
    
    public function __construct(){
        parent::__construct($this->host, $this->nombreUsuario, $this->passUsuario, $this->nombreBd);
    }
    
    public function __get($atributo) {
        return $this->$atributo;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
    public function insertar(){
        
    }
}

if(isset($_POST["mostrar"])){
    echo "<form action='' method='POST'>";
    echo "Codigo del producto: <input type='text' name='cod'>";
    echo "<input type='submit' name='buscarcod' value='Buscar Productos'>";
    echo "</form>";
}
if(isset($_POST['buscarcod'])){
    $p=producto::buscarProducto($_POST["cod"]);
    //diferenciar en tre 0 y false con ===
    if($p===false){
        echo "Error em ña BD";
        
    }
    else{
        if($p){
            echo $p;
        }
            
        else{
            echo "no existe el producto";
        }
            
    }
    return $p;
}




