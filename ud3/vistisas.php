<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contador</title>
</head>
<body>
    <?php
        //echo var_dump($_SERVER);
        //dolar session para cada vezque recarge aument
        /*
        foreach($_SERVER as $clave =>$valor){

        }
        */
        define('RUTA_FICHERO',"/var/www/html/ejemplofichero/cuenta.txt");
        if(file_exists(RUTA_FICHERO)){
            $cuentaglobal=file_get_contents(RUTA_FICHERO);
            $cuentaglobal++;
        }else{
            $cuentaglobal=1;
        }
        
        file_put_contents(RUTA_FICHERO,$cuentaglobal);

        if(!isset($_SESSION['contador'])){
            $_SESSION['contador']= 1;
        }
          else {
            $_SESSION['contador']=$_SESSION['contador'] +1;
        }
        echo "visitas globales ".$cuentaglobal;
        echo " <p>tus visitas :".$_SESSION['contador'] ."</p>";
        echo "<p><a href=volver></a></p>";
    
    ?>
</body>
</html>