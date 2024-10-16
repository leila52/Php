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
</html>