<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Adivinaaaaaaaa</h1>
<?php
    define('TOPE',50);
    if(!isset($_POST['usuario'])){
        //generar numero
        $numaAle=rand(1,TOPE);
        $intentos=0;
        $mensaje="adivina el numero entre 1 y 50";

    }else{
        $numaAle = intval($_POST['numaAle']);
        $intentos=intval($_POST['intentos'])+1;
        $numero=intval($_POST['usuario']);
        if($numero < $numaAle){
            $mensaje="el numero que hay que adivinar es mayor";
        }
        else if($numero > $numaAle){
            $mensaje="el numero que hay que encontrar es menor";
        
        }else{
            $mensaje="has hacertado oleeee";
            $numaAle= rand(1, TOPE);
            $intentos=0;
        }
    }
?>
    <p><?php echo $mensaje; ?></p>
    <form action="" method="post">
       <label for="numero">Introduce el número:</label>
        <input type="usuario" id="usuario" name="usuario" ><br>
        <br>
        <input type="hidden" name="numaAle" value="<?php echo $numaAle; ?>">
        <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
        <button type="submit">enviar</button>
    </form>
</body>
</html> 