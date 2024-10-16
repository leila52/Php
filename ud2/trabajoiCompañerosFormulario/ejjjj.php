<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_FILES['fichero'])){
            $archivo = $_FILES['fichero'];
            $nombreArchivo = $archivo['name'];
            $tipoArchivo = $archivo['type'];
            $rutaTemporal = $archivo['tmp_name'];
            $tamañoArchivo = $archivo['size'];
            $rutaDestino = "Descargas/" . $nombreArchivo;
            echo "Archivo cargado exitosamente: $nombreArchivo <br>";
            echo "Tipo de archivo: $tipoArchivo <br>";
            echo "Tamaño del archivo: $tamañoArchivo bytes<br>";
            echo "Ruta del archivo: $rutaDestino <br>";

            //otra manera
            echo"<br>";
            echo"otra manera de hacerlo";
            foreach($_FILES['fichero'] as $clave =>$valor){
                echo " <p>$clave : $valor</p>";
            }

            //forech de files
            echo"<br>";
            echo"otra manera de hacerlo";
            foreach($_FILES as $claves =>$valors){
                echo " <p> $claves </p>";
                foreach($valors as $k => $v){
                    echo "<p> $k : $v </p>";
                }
            }
            
        }
        

    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
    <label for="">Subir archivo:</label>
    <input type="file" name="fichero">
    <input type="file" name="fichero2">
    <button type="submit">Enviar</button>
</form>
</body>
</html>