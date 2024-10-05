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
            $numaAle = intval($_POST['numaAle']);
            $intentos = intval($_POST['intentos']) + 1; 
            $usuario = intval($_POST['usuario']);
            if ($usuario > $numaAle) {
                $mensaje = "el numero es menor que $adivinado. Llevas $intentos intentos.";
            } elseif ($usuario < $numaAle) {
                $mensaje = "el numero es mayor que $adivinado. Llevas $intentos intentos.";
            } else {
                $mensaje = "oleeeee has adivinado el nnmero en $intentos intentos.";
                $numaAle= rand(1, TOPE); 
                $intentos = 0; 
            }
            /* http://localhost/php */
        
    ?>
    <h1>Adivinaaaaaaaa</h1>
    <p><?php echo $mensaje; ?></p>
    <form action="formulario.php" method="post">
        <label for="numero">Introduce el número:</label>
        <input type="usuario" id="usuario" name="usuario" required><br>
        <br>
        <input type="hidden" name="numaAle" value="<?php echo $numaAle; ?>">
        <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
        <button type="submit">enviar</button>
    </form>
</body>
</html>