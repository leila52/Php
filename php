Adivinar.php                                                                                        000664  001753  001753  00000003422 14701155064 013074  0                                                                                                    ustar 00daw2                            daw2                            000000  000000                                                                                                                                                                         <!DOCTYPE html>
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
</html>                                                                                                                                                                                                                                              form.php                                                                                            000664  001753  001753  00000001535 14700714157 012310  0                                                                                                    ustar 00daw2                            daw2                            000000  000000                                                                                                                                                                         <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ej1</title>
    <style>
        #texto{
            color: black;
        }
        div{
            border: solid 1px black;
            width: 250px;
        }
    </style>
</head>
<body>
    <?php 
    $textoAntiguo=$_POST["texto"] ?? "";
    $mensaje = !empty($_POST["msg"]) ? $_POST["msg"] : "";
    if (!empty($mensaje)){
    $textoAntiguo=empty($textoAntiguo) ? "$mensaje" : "$textoAntiguo<br>$mensaje";
    }
    ?>
    <form method="post">
        <label for="msg">Nuevo mensaje:</label>
        <input type="text" id="msg" name="msg">
        <input type="submit" value="Enviar"><br><br>
        <label for="texto">Mensajes Antiguos:</label>
        <input type="hidden" value="<?=$textoAntiguo?>" name="texto">
    </form>
    <div><?=$textoAntiguo?></div>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   