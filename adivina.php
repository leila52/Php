<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el numero xula</title>
</head>
<body>
    <?php
        //campo hidden para guardar el numero aleatorio
        define('TOPE',50)
        $numAle=rand(1,TOPE);
    ?>
    <form action="formulario.php" method="post">
        <label for="numero">Introduce el mu,ero:</label>
        <input type="number" id="numero" name="numero"><br>
        <button type="submit">comprobar</button>
    </form>
</body>
</html>