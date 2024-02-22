<!doctype html>
<html>
    <head>
        <title>MENU</title>
    </head>
    <body>
        <?php
        require_once '../controller/controllerUsuario.php';
            require_once '../controller/controllerCita.php';
        session_start();
        
        if(!isset($_SESSION["usuarioLogueado"]) && $_SESSION["usuarioLogueado"]==null ){
            header("location:index.php");
        }
        


        
        ?>
        <h2> Hola administrador de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h2><br>
        <h3>Telefono: <?php echo $_SESSION["usuarioLogueado"]->telefono ?></h3>
            
        <a href="index.php">Cerrar Sesion</a><br><br>
         
        <h1>GESTION DE CITAS DE LAS ITVs de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h1><br><br>
        
        
        <a href="nuevaCita.php">Registro nueva cita</a><br>
        
        <a href="listado.php">Listado de sedes de ITV</a><br><br>
        
        <?php
        if(isset($_SESSION["citaInsertada"]) && $_SESSION["citaInsertada"] != null){
            echo "<br><br><h3>El vehiculo con la matricula".$_SESSION["citaInsertada"]->matricula.", tiene una cita el dia".$_SESSION["citaInsertada"]->fecha." a la hora ".$_SESSION["citaInsertada"]->hora."</h3><br>";
            $_SESSION["citaInsertada"] = null;
            
        }       
        ?>
        
            
    </body>
</html>

