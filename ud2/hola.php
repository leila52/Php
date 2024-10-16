<html>
    <head>
        <title>primer programa</title>
    </head>
    <body>
        <?php
        /*http://localhost/hola.php?nombre=juan*/
        $nombre=$_GET["nombre"] ?? "mundo";
        if(isset($_GET["nombre"])){
            echo "hola ".$nombre;
        }else{
            echo "hola mundo";
        }
        ?>
    </body>
</html>
