
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
                    <form method="post" action="">
                    <p><input type="text" name="user" value="" placeholder="Usuario"></p>
                    <p><input type="password" name="password" value="" placeholder="Password"></p>                
                    <p class="submit"><input type="submit" name="login" value="login"></p>
                    </form>
            </div>
 
            <div class="login-help">
                <p>No posee cuenta? registrate <a href="registro.php">AQUI</a>.</p>
                <p>usuario por defecto=admin:pass=admin </p>
                <iframe src="http://www.facebook.com/plugins/like.php?locale=es_ES&href=http://testbuscador.260mb.org/login.php&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=trebuchet+ms&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
            </div>
        </div>
        
        <?php
      
        session_start();
        include_once "conexion.php";
        
        function verificar_login($user,$password,&$result) {
            $sql = "SELECT * FROM usuarios WHERE usuario = '$user' and password = '$password'";
            $rec = mysql_query($sql);
            $count = 0;
 
            while($row = mysql_fetch_object($rec))
            {
            $count++;
            $result = $row;
            }
 
            if($count == 1)
            {
            return 1;
            }
 
            else
            {
            return 0;
            }
        }
 
//
if(!isset($_SESSION['userid']))
{
    if(isset($_POST['login']))
    {
        if(verificar_login($_POST['user'],  md5($_POST['password']) ,$result) == 1)
        {
            $_SESSION['userid'] = $result->idusuario;
            header("location:index.php");
        }
        else
        {
            ?>
                    <div class="login-help">
                        <p>Su usuario es incorrecto, intente nuevamente.</p>
                        <p><a href="login.php">Volver</a></p>
                    </div>
            <?php
        }
    }
}
else {
    header("location:index.php");
    
}
?>       
    </body>
</html>
