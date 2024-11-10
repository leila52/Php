
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Adivinar el Número</title>
</head>
<body>
<?php
// definimos el top
    define('TOPE',50);

    //si no este el campo lleno
    if(!isset($_POST["miNum"])){
        $miNum=rand(1,TOPE);
        $intentos=0;
        $mensaje=" adivina el numero entre 1 y " . TOPE.".";

    }else{
        $miNum=intval($_POST['miNum']);

        $intentos=intval($_POST['intentos']) + 1;
        //numero del usuario
        $adivinado=intval($_POST['numero']);
        if($adivinado > $miNum){
            $mensaje="el numero es menor llevas $intentos intentos";
        }else if($adivinado < $miNum){
            $mensaje="el numero es mayor llevas $intentos intentos";
        }else{
            $mensaje="has acertado oleeeeeeee";
            //reiniciamos el juego
            $miNum=rand(1,TOPE);
            $intentos=0;
        }
    }
?>
    <h1>Juego de Adivinar el Número</h1>
    <p><?php echo $mensaje; ?></p>

    <!-- Formulario para enviar la adivinanza -->
    <form action="" method="post">
        <label for="numer">Introduce el número:</label>
        <input type="number" id="numero" name="numero" required><br>
        <br>
        <!-- Campo oculto para mantener el número aleatorio generado -->
        <input type="hidden" name="miNum" value="<?php echo $miNum; ?>">
        <!-- Campo oculto para llevar el conteo de intentos -->
        <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
        <button type="submit">Comprobar</button>
    </form>
</body>
</html>