<!doctype html>
<html>
    <head>
        <title>nuevaCita</title>
    </head>
    <body>
        <?php
        require_once '../controller/controllerCita.php';
        require_once '../controller/controllerUsuario.php';
        require_once '../controller/controllerVehiculo.php';
        require_once '../controller/controllerItv.php';
        session_start();
        
        if(!isset($_SESSION["usuarioLogueado"])  && $_SESSION["usuarioLogueado"]==null ){
            header("location:index.php");
        } 
        ?>
        
        <h2> Hola administrador de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h2><br>
        <h3>Telefono: <?php echo $_SESSION["usuarioLogueado"]->telefono ?></h3>
            
        <a href="index.php">Cerrar Sesion</a><br>
        <a href="menu.php">Volver al menu</a><br><br>
        
        <h1>GESTION DE CITAS DE LAS ITVs de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h1><br><br>
        
        
        

        
        
        <form action="" method="POST" name="form1">
            Matricula <input type="text" name="matricula">
            
            <input type="submit" name="buscar" value="Buscar">
        </form>
        
        
        <?php
        if(isset($_POST["anular"])){
            
            if(controllerCita::borrarCita($_POST["matricula"])){
                echo "<br><h3>Se ha anulado la cita correctamente</h3>";
            }
            else{
                echo "<br><h3 style='color:red'>Ha ocurrido un error al intentar anularla</h3>";
            }
            
        }
        
        
        if(isset($_POST["registrarCita"])){

            
            
            if(isset($_FILES["foto"]) && is_uploaded_file($_FILES["foto"]["tmp_name"])){
                $fich = time()."-".$_POST["matricula"]."-ficha";
                
                //se crea la variable que contiene la ruta de la imagen
                $ruta = "../imagenes/".$fich;
                
                //añade la imagen a la ruta
                move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
                
                
                echo $ruta;
                
                $cita = new Cita($_POST["matricula"], $_POST["itv"], $_POST["fecha"], $_POST["hora"], $ruta);
                
                $filasAfectadas = controllerCita::insertar($cita);

                if($filasAfectadas > 0){
                    $_SESSION["citaInsertada"] = $cita;
                    
                    //Actualizamos la fecha de la ultima revision del vehiculo a la qeu acabamos de insertar
                    $filasAfectadas = controllerVehiculo::actualizarFecha($_POST["matricula"], $_POST["fecha"]);
                    
                    //sin no ha afectado a ninguna fila a ocurrido un error
                        if($filasAfectadas<1){
                            echo "<h3 style='color:red'> HA OCURRIDO UN ERROR AL ACTUALIZAR LA FECHA";
                        }
                        else{
                            header("location:menu.php");
                        }
                    
                }
                else{
                    echo "<h3 style='color:red'>Se ha producido un error en la insercion de la imagen;</h3><br>";
                }
                
                
            }
            else{
                echo "<h1 style='color:red'>Ha ocurrido un error a la hora de añadir la imagen</h1><br>";
            }
            
            
            
            
            
            
            
            
            
        }
        
        
        
        
        
        if(isset($_POST["buscar"])){
            //bucaremos si existe una cita para el coche
            $matri = $_POST["matricula"];
            
            //comprobamos que la matricula sea correcta y exista un vehiculo que corresponda a ella
            if(controllerVehiculo::encontrar($matri)){
                $ci = controllerCita::encontrar($matri);
                
                //comprobamos que no exista una cita previa
                if($ci == false){
                    echo "<h1>Existe una cita a esa matricula ya</h1>";
                    ?>
                    <form action="" method="POST" name="form2">
                        <input type="hidden" name="matricula" value="<?php echo $matri ?>">
                        <input type="submit" name="anular" value="anular">
                    </form>
                    <?php
                }
                else{
                    //la matricula existe y el vehiculo no tiene cita
                    
                    $vehi = controllerVehiculo::encontrarDatos($matri);
                    
                    $vehiculo = new Vehiculo($vehi->matricula, $vehi->marca, $vehi->modelo, $vehi->color, $vehi->plazas, $vehi->fecha_ultima_revision);
                    
                    ?>
                    <form action="" name="form2" method="POST" enctype="multipart/form-data">
                        <br><h3>Datos del vehiculo:</h3><br><br>;

                        Matricula: <input type="text" name="matricula" value="<?php echo $vehiculo->matricula ?>" disabled=""><br>
                        Modelo: <input type="text" name="modelo" value="<?php echo $vehiculo->modelo ?>"disabled=""><br>
                        Plazas: <input type="text" name="plazas" value="<?php echo $vehiculo->plazas ?>"disabled=""><br>
                        Marca: <input type="text" name="marca" value="<?php echo $vehiculo->marca ?>"disabled=""><br>
                        Color: <input type="text" name="color" value="<?php echo $vehiculo->color ?>"disabled=""><br>
                        Fecha ultima revision: <input type="text" name="fecha" value="<?php echo $vehiculo->fecha_ultima_revision ?>"disabled=""><br>
                        <br><br>
                        
                        
                        
                        <h3>Elegir ITV:</h3><br>
                        
                        
                        <select name="itv">
                            <?php 
                            
                            
                            $result =controllerItv::encontrar($_SESSION["usuarioLogueado"]->provincia);
                            
                            while ($reg = $result->fetch_object()){
                                
                                echo "<option value='$reg->id'>$reg->localidad-$reg->direccion</option>";
                            }
                            ?>
                            
                        </select>
                        
                        <br>
                        Fecha:<input name="fecha" type="date" required=""><br>
                        Hora: <input name="hora" type="time" required=""><br><br>
                        
                        Ficha tecnica: <input type="file" name="foto" required=""><br><br>
                        
                        <input hidden="matricula" name="matricula" value="<?php echo $matri; ?>">
                        <input type="submit" name="registrarCita" value="Registrar Cita">
                        
                        
                    
                    </form>
                    
                    
                    
                    
                    
                    <?php
                }
            }
            else{
                echo "<h1 style='color:red'>no se ha encontrado ningun vehiculo que corresponda con la matricula: ".$matri."</h1>";
            }
            
            
                
        
            
        
    }
        ?>
        
        
        
        <?php
        ?>
    </body>
</html>


<?php
?>

