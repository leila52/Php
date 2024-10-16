<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>datos del formulario</title>
</head>
<body>
    <?php
            // hazlo con post
            $nombre = $_POST["nombre"];
            $comentario = $_POST["comentario"];
            
            echo "Datos recibidos: ";
            echo "El nombre es: " .$nombre . "<br>";
            echo "El comentario es: " . $comentario . "<br>";
        
    ?>
</body>
</html>