<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/estilo.css" media="all">
        <title></title>
    </head>
    <body>
        
        <div class="container">
            <div class="login">
                <h1>Login</h1>
                    <form method="post" action="" class="registro">
                    <p><input type="text" name="usuario" placeholder="Usuario"></p>
                    <p><input type="password" name="password" placeholder="Contraseña"></p>
                    <p><input type="password" name="repassword" placeholder="Repita la contraseña"></p>
                    <p class="submit"><input type="submit" name="enviar" value="Registrar"></p>
                    </form>
            </div>
        
        <?php
        
        include_once 'conexion.php';
        
        if(isset($_POST['enviar']))
        {
            if($_POST['usuario'] == '' or $_POST['password'] == '' or $_POST['repassword'] == '')
            {
                
                ?>
                  <div class="login-help">
                  <p>Por favor llene todos los campos</p>
                  <p><a href="login.php">Volver</a></p>
                  </div>
                <?php
                 
            }
            else
            {
                $sql = 'SELECT * FROM usuarios';
                $rec = mysql_query($sql);
                $verificar_usuario = 0;

                while($result = mysql_fetch_object($rec))
                {
                    if($result->usuario == $_POST['usuario'])
                    {
                        $verificar_usuario = 1;
                    }
                }

                if($verificar_usuario == 0)
                {
                    if($_POST['password'] == $_POST['repassword'])
                    {
                        $usuario = $_POST['usuario'];
                        $password = md5($_POST['password']);
                        $sql = "INSERT INTO usuarios (usuario,password) VALUES ('$usuario','$password')";
                        mysql_query($sql);
                        
                        ?> 
                        <div class="login-help">
                        <p>Usuario creado</p>
                        </div>
                        <?php

                        header("location:login.php");
                        
                    }
                    else
                    {
                        ?>
                        <div class="login-help">
                        <p>Las claves no son iguales, intente nuevamente.</p>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="login-help">
                        <p>Este usuario ya ha sido registrado anteriormente.</p>
                        <p><a href="login.php">Volver</a></p>
                        </div>
                    <?php
                    
                }
            }
        }
        ?>
    </body>
</html>
