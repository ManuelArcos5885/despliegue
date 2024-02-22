<!doctype html>
<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <?php
        require '../controller/controllerUsuario.php';
        session_start();
        
        $_SESSION["usuarioLogueado"] = null;
        
        if(isset($_POST["accceder"])){
            
            $usu = controllerUsuario::encontrar($_POST["usu"]);
            
            if($usu != false){
                


                $usuarioLogin = new Usuario($usu->provincia, $usu->nombre, $usu->telefono, $usu->user, $usu->pass);






                if(password_verify($_POST["pass"], $usuarioLogin->pass)){
                    $_SESSION["usuarioLogueado"] = $usuarioLogin;

                    header("location:menu.php");
                }

                else{
                    $_COOKIE["falloEntrar"] = "false";
                }
            }
            else{
                $_COOKIE["falloEntrar"] = "false";
             }
            
            
            
        }
        if(!isset($_COOKIE["falloEntrar"])){
            $_COOKIE["falloEntrar"] = "no logueado";
        }
        
        ?>
        
        <h1>Gestion de citas ITV Andalucia</h1><br>
        <form action="" method="POST" name="form1">
            Usuario<input type="text" name="usu"><br>
            Clave<input type="password" name="pass"><br><br>
            
            <input type="submit" name="accceder" value="Acceder"><br>
            
            <?php

            ?>
        </form>
        
        <?php
        if(isset($_COOKIE["falloEntrar"]) && $_COOKIE["falloEntrar"]=="false"){
            echo "<h3 style='color:red'>Usuario o clave incorrecta</h3>";
        }
        
        ?>

    </body>
</html>




