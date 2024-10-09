<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adivina un num</title>
    <style>
        textarea{
            color: black;
        }
        h3{
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_POST['reiniciar'])){
        $numSecreto=rand(1,50);
        $numIntentos=-1;
        $numIntentos++;

    }
    else{
        $random=rand(1,50);
        $numSecreto=$_REQUEST["miNum"] ?? $random;
        $numIntentos=$_REQUEST["intentos"] ?? -1;
        $numIntentos++;
    }
    $cad="";
    echo "";
    ?>
    <form method="post">
        <label for="num">Introduzca un numero entre el 1 y 50</label><input type="text" name="num" id="num">
        <input type="hidden" name="miNum" value="<?=$numSecreto?>">
        <input type="hidden" name="intentos" value="<?=$numIntentos?>">
        <button type="submit">Enviar</button>
        <button name="reiniciar">Generar numero nuevo</button>
    </form>
    <?php 
    $numIntro=!empty($_POST["num"]) ? $_POST["num"] : "No introducido";
   
    function numeroCorrecto($numSecreto, $numIntro, $numIntentos){
        
        if($numIntro=="No introducido"){
            return "";
        }
        if($numSecreto==$numIntro){
            return "Has adivinado el numero secreto($numSecreto)!!(lo has intentado $numIntentos veces)";
        }
        if($numSecreto<$numIntro){
            return "El numero secreto es menor";
        }
        if($numSecreto>$numIntro){
            return "El numero secreto es mayor";
        }
    }
    if(!empty($_POST["num"])){
    if(!is_numeric($numIntro)){
        $cad="Tienes que introducir un numero";
    }
    else{
    $cad=numeroCorrecto($numSecreto,$numIntro, $numIntentos);
    }
}
    echo "<h3>$cad</h3>";
    
    ?>
</body>
</html>