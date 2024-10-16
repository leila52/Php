<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 
//var_dump($_SERVER);
//echo "<p> hola " . $_SERVER["HTTP HOST"] ." </p>";


if (isset($_REQUEST["nombre"])) {
    if (!empty($_REQUEST["nombre"])) {
        echo "Hola " . $_REQUEST["nombre"] ;
    }
    else {
        echo "Hola mundo"; 
    }
    echo "<p><a href=\"holamundo.php\">Volver</a></p>";
}
else {
 echo <<<END
<form method="POST" action="http://localhost/holamundo.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" />
    <input type="submit" value="Enviar" />
</form>


END;

}
?>

</body>
</html>

