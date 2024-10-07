<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el numero xula</title>
    
</head>
<body>
<?php

        define('TOPE', 50); 
        if (!isset($_POST['usuario'])) {
            // generamos el número aleatorio solo la primera vez
            $miNum = rand(2, TOPE);
            $intentos = 0; // inicializamos los intentos
            $mensaje = "Adivina un número entre 1 y " . TOPE . ".";
        }else{
            $numaAle = intval($_POST['numaAle']);
            $intentos = intval($_POST['intentos']) + 1; 
            $usuario = intval($_POST['usuario']);
            if ($usuario > $numaAle) {
                $mensaje = "el numero es menor que $usuario,llevas $intentos intentos.";
            } 
            if ($usuario < $numaAle) {
                $mensaje = "el numero es mayor que $usuario, llevas $intentos intentos.";
            } else {
                $mensaje = "oleeeee has adivinado el numero en $intentos intentos.";
                $numaAle= rand(2, TOPE); 
                $intentos = 0; 
            }

        }
        
    ?>
    <h1>Adivinaaaaaaaa</h1>
    <p><?php echo $mensaje; ?></p>
    <form action="" method="post">
        <label for="numero">Introduce el número:</label>
        <input type="usuario" id="usuario" name="usuario" required><br>
        <br>
        <input type="hidden" name="numaAle" value="<?php echo $numaAle; ?>">
        <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
        <button type="submit">enviar</button>
    </form>
</body>
</html>