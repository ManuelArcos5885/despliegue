<!doctype html>
<html>
    <head>
        <title>Citas</title>
    </head>
    <body>
        <?php 
        require_once '../controller/controllerUsuario.php';
        require_once '../controller/controllerCita.php';
        require_once '../controller/controllerVehiculo.php';
        session_start();
        
        if(!isset($_SESSION["usuarioLogueado"]) && $_SESSION["usuarioLogueado"]==null ){
            header("location:index.php");
        }
        if(!isset($_POST["misCitas"])){
            header("location:menu.php");
        }
        
        ?>
        <h2> Hola administrador de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h2><br>
        <h3>Telefono: <?php echo $_SESSION["usuarioLogueado"]->telefono ?></h3>
        
        <a href="index.php">Cerrar Sesion</a><br>
        <a href="menu.php">Volver al menu</a><br><br>
        
        <h2>Vehiculos con cita de la localidad de <?php echo $_POST["localidad"]; ?></h2><br><br> 
        
        
        
        
        
        
        <?php
        $result = controllerCita::encontrarTodas($_POST["id"]);
            
        //si devuelve false no imprimimos la tabla ya que no existen citas para esa localidad
            if($result == false){
                echo "<tr><h1>No existen citas de ITV para esta localidad</h1></tr>";
            }
            else{
                
            
        ?>
        
        
        <table style="border: 1px solid black">
            <tr style="border: 1px solid black">
                <td>Matricula</td>
                <td>Marca</td>
                <td>Modelo</td>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Ficha tecnica</td>
            </tr>
            
            <?php 
            
            
            while ($reg = $result->fetch_object()){
                
                $vehiculo = controllerVehiculo::encontrarDatos($reg->matricula);
               
                
                echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>'$reg->matricula</td>";
                echo "<td style='border: 1px solid black'>'$vehiculo->marca</td>";
                echo "<td style='border: 1px solid black'>'$vehiculo->modelo</td>";
                echo "<td style='border: 1px solid black'>'$reg->fecha</td>";
                echo "<td style='border: 1px solid black'>'$reg->hora</td>";
                echo "<td style='border: 1px solid black'>";
                echo "<a href='$reg->ficha' target='_blank'>Ver mi Ficha</a>";

                echo "</td>";
                echo "</tr>";
            }
            ?>
            
        </table>
        
            
        
        
        <?php
            }
        ?>
        
    </body>
</html>


