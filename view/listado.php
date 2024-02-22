<!doctype html>
<html>
    <head>
        <title>Listado ITVS</title
        
        <style>
            
        </style>
    </head>
    <body>
        <?php 
        require_once '../controller/controllerUsuario.php';
        require_once '../controller/controllerItv.php';
        session_start();
        
        if(!isset($_SESSION["usuarioLogueado"]) && $_SESSION["usuarioLogueado"]==null ){
            header("location:index.php");
        }
        
        
        
        ?>
       
        <h2> Hola administrador de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h2><br>
        <h3>Telefono: <?php echo $_SESSION["usuarioLogueado"]->telefono ?></h3>
        
        <a href="index.php">Cerrar Sesion</a><br>
        <a href="menu.php">Volver al menu</a><br><br>
        
        <h2>Sedes de ITV de la provincia de <?php echo $_SESSION["usuarioLogueado"]->provincia; ?></h2><br><br>      
        
        <?php
        $result =controllerItv::encontrar($_SESSION["usuarioLogueado"]->provincia);
            
            if($result == false){
                echo "<tr><h1>No existen sedes de ITV para esta provincia</h1></tr>";
            }
            else{
                
            
        ?>
        
        
        <table style="border: 1px solid black">
            <tr style="border: 1px solid black">
                <td>Localidad</td>
                <td>Direccion</td>
                <td>Citas</td>
            </tr>
            
            <?php 
            
            
            while ($reg = $result->fetch_object()){
                echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>'$reg->localidad</td>";
                echo "<td style='border: 1px solid black'>'$reg->direccion</td>";
                echo "<td style='border: 1px solid black'>";
                ?>
            <form method='POST' action='citas.php'>
                <input type='hidden' name='localidad' value='<?php echo $reg->localidad ?>'>
                <input type='hidden' name='id' value='<?php echo $reg->id ?>'>
                <input type='submit' name='misCitas' value='Mis citas'>
            </form>
                
                <?php
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

<?php
?>
